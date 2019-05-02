<?php

namespace App;

use App\Traits\ImageUploader;
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
        $path = '';
        if ($request->has('image')) {
            $path = $this->uploadImage($request->image);
        }

        return $this->images()->create([
            'title' => $request->title !== '' && $request->title !== 'null' ? $request->title : null,
            'subtitle' => $request->subtitle !== '' && $request->subtitle !== 'null' ? $request->subtitle : null,
            'btn_label' => $request->btn_label !== '' && $request->btn_label !== 'null' ? $request->btn_label : null,
            'btn_link' => $request->btn_link !== '' && $request->btn_link !== 'null' ? $request->btn_link : null,
            'path' => $path,
            'order' => $this->images()->count() + 1
        ]);
    }

    public function updateSlide(SliderImage $sliderImage)
    {
        return $this->images()->where('id', $sliderImage->id)->update($sliderImage->toArray());
    }
}
