<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use Translatable, ImageUploader;

    protected $fillable = ['name', 'description', 'lat', 'lng', 'slug'];
    protected $translationAttributes = ['name', 'description'];
    protected $with = ['developer', 'location', 'propertyTypes', 'images', 'translation'];
    protected $appends = ['logo_url'];

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getLogoUrlAttribute()
    {
        return $this->getImageUrl($this->logo);
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
