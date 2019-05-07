<?php

namespace App;

use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Slider extends Model
{
    use ImageUploader;

    public $timestamps =false;
    public $fillable = ['name', 'main'];

    public function images()
    {
        return $this->hasMany(SliderImage::class);
    }

    public function addSlide(Request $request): SliderImage
    {
        $sliderImage = new SliderImage;
        if ($request->has('image')) {
            $sliderImage->path = $sliderImage->uploadImage($request->image);
        }

        foreach ($request->all() as $key => $value) {
            if (in_array($key, $sliderImage->getFillable())) {
                if ($value) {
                    $sliderImage->{$key} = $value;
                }
            }
        }

        $sliderImage->order = $this->images()->count() + 1;
        $sliderImage = $this->images()->create($sliderImage->toArray());
        if ($sliderImage) {
            if ($request->has('translation')) {
                $translations = [];
                foreach ($request->translation as $key => $value) {
                    if ($value) $translations[$key] = $value;
                }

                $sliderImage->addTranslation($translations);
            }
        }

        return $sliderImage;
    }

    public function updateSlide(SliderImage $sliderImage, Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (key_exists($key, $sliderImage->attributes)) {
                if ($value) $sliderImage->{$key} = $value;
            }
        }

        if ($request->hasFile('image')) {
            $sliderImage->path = $sliderImage->updateImage($request->image, $sliderImage->path);
        }

        $sliderImage->save();
        if ($request->has('translation')) {
            $translations = [];
            foreach ($request->translation as $key => $value) {
                if ($value) $translations[$key] = $value;
            }

            $sliderImage->updateTranslation($translations);
        }
    }

    public function scopeMain(Builder $query): Builder
    {
        return $query->whereMain(true);
    }
}
