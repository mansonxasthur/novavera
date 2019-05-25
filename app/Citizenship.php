<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Citizenship extends Model
{
    use Translatable, ImageUploader;

    protected $translationAttributes = ['country_name', 'title', 'description', 'snippet'];
    protected $with = ['translation', 'benefits', 'supplies'];
    public $appends = [
        'header_url',
        'dropdown_flag_url',
        'body_flag_url',
        'path'
    ];

    public function benefits()
    {
        return $this->hasMany(CitizenshipBenefit::class);
    }

    public function supplies()
    {
        return $this->hasMany(CitizenshipSupply::class);
    }

    public function getDropdownFlagUrlAttribute()
    {
        return $this->getImageUrl($this->dropdown_flag);
    }

    public function getBodyFlagUrlAttribute()
    {
        return $this->getImageUrl($this->body_flag);
    }

    public function getHeaderUrlAttribute()
    {
        return $this->getImageUrl($this->header);
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function addBenefits(array $benefits)
    {
        foreach ($benefits as $benefit) {
            $benefitModel = $this->benefits()->create([
                'detail' => $benefit->en,
            ]);
            $benefitModel->addTranslation([
                'detail' => $benefit->ar,
            ]);
        }
    }

    public function addSupplies(array $supplies)
    {
        foreach ($supplies as $supply) {
            $supplyModel = $this->supplies()->create([
                'detail' => $supply->en,
            ]);
            $supplyModel->addTranslation([
                'detail' => $supply->ar,
            ]);
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param string $value
     */
    public function setSlugAttribute(string $value)
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * @param string $slug
     *
     * @return string
     */
    private function incrementSlug(string $slug): string
    {
        $max = static::where('country_name', $this->country_name)->latest('id')->first();

        if ($max->id !== $this->id) {
            $max = $max->slug;
            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($matches) {
                    return $matches[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }

    public function path()
    {
        $locale = App::getLocale();
        return '/' . $locale . '/countries/' . $this->type . '/' . $this->slug;
    }
}
