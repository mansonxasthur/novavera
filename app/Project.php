<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Project extends Model
{
    use Translatable, ImageUploader;

    protected $fillable = ['name', 'price', 'down_payment', 'installment_years', 'delivery_date', 'description', 'lat', 'lng', 'slug'];
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

    public static function installation(Request $request): Project
    {
        $project = new static();
        $project->name = $request->name;
        $project->slug = $request->name;
        $project->developer_id = $request->developer;
        $project->project_type = $request->projectType;
        $project->location_id = $request->location;
        $project->lat = $request->lat;
        $project->lng = $request->lng;
        $project->description = $request->description;
        $project->meta = $request->meta;
        $project->keywords = $request->keywords;
        if ($request->hasFile('logo')) {
            $project->logo = $project->uploadImage($request->logo);
        }

        if ($request->has('price') && $request->price !== null) {
            $project->price = $request->price;
        }

        if ($request->has('down_payment') && $request->down_payment !== null) {
            $project->down_payment = $request->down_payment;
        }

        if ($request->has('installment_years') && $request->installment_years !== null) {
            $project->installment_years = $request->installment_years;
        }

        if ($request->has('delivery_date') && $request->delivery_date !== null) {
            $project->delivery_date = $request->delivery_date;
        }

        $project->save();

        return $project;
    }

    public function updateInstallation(Request $request): bool
    {
        $this->name = $request->name;
        $this->slug = $request->name;
        $this->developer_id = $request->developer;
        $this->project_type = $request->projectType;
        $this->location_id = $request->location;
        $this->lat = $request->lat;
        $this->lng = $request->lng;
        $this->description = $request->description;
        $this->meta = $request->meta;
        $this->keywords = $request->keywords;

        if ($request->has('price') && $request->price !== null) {
            $this->price = $request->price;
        }

        if ($request->has('down_payment') && $request->down_payment !== null) {
            $this->down_payment = $request->down_payment;
        }

        if ($request->has('installment_years') && $request->installment_years !== null) {
            $this->installment_years = $request->installment_years;
        }

        if ($request->has('delivery_date') && $request->delivery_date !== null) {
            $this->delivery_date = $request->delivery_date;
        }
        if ($request->hasFile('logo')) {
            $this->logo = $this->updateImage($request->logo, $this->logo);
        }
        return $this->save();
    }

}
