<?php

namespace App;

use App\Traits\Translatable;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Developer extends Model
{
    use Translatable, ImageUploader;

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'slug'];
    protected $translationAttributes = ['description'];
    protected $appends = ['logo_url'];
    protected $with = ['translation'];

    public function projects()
    {
        return $this->hasMany(Project::class);
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

    public function getLogoUrlAttribute()
    {
        return $this->getImageUrl($this->logo);
    }

    /**
     * @param string $slug
     * @return string
     */
    private function incrementSlug(string $slug): string
    {
        $max = static::whereName($this->name)->latest('id')->first();

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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
