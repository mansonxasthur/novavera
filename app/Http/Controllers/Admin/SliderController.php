<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\Slider;
use App\SliderImage;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index')->with(['sliders' => Slider::all()]);
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit')->with(['slider' => $slider->load('images')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $slider = Slider::create(['name' => $request->name]);

            return response()->json(['message' => 'Success', 'data' => $slider], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'name' => 'required|string',
            'images' => 'required|array'
        ]);

        try {
            if ($request->name !== '' || $request->name !== null && $request->name !== $slider->name) {
                $slider->update(['name' => $request->name]);
            }

            if (is_array($request->images) && count($request->images)) {
                foreach ($request->images as $image) {
                    SliderImage::where('id', $image['id'])->update(['order' => $image['order']]);
                }
            }

            return response()->json(['message' => 'Success', 'data' => $slider], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function toggleMain(Slider $slider, Request $request)
    {
        $request->validate(['main' => 'required']);

        try {
            if ($main = $request->main) {
                Slider::where('id', '<>', $slider->id)
                    ->update(['main' => false]);
            }

            $slider->update(['main' => $main]);

            $message = $main ? 'Slider assigned to main page!' : 'Slider removed from main page!';
            return response()->json(['message' => $message], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Slider $slider)
    {
        try {
            $slider->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function addSlide(Request $request, Slider $slider)
    {

        $request->validate(['image' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:5000']);
        try {
            $sliderImage = $slider->addSlide($request);

            return response()->json(['message' => 'Success', 'data' => $sliderImage->load('translation')], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function updateSlide(Request $request, Slider $slider, SliderImage $sliderImage)
    {
        try {
            $slider->updateSlide($sliderImage, $request);

            $sliderImage->save();

            return response()->json(['message' => 'Success', 'data' => $sliderImage->fresh()], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function removeSlide(Slider $slider, SliderImage $sliderImage)
    {
        try {
            $sliderImage->delete();

            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
