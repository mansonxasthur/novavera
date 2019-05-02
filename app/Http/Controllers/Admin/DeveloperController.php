<?php

namespace App\Http\Controllers\Admin;

use App\Developer;
use App\Facades\Logger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index() {
        return view('admin.developer.index', ['developers' => Developer::all()]);
    }

    public function store(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:5000'
        ]);

        try {
            $developer->logo = $developer->uploadImage($request->logo);

            $developer->slug = $developer->name = $request->name;
            if ($request->has('description') && $request->description !== '') {
                $developer->description = $request->description;
            }

            $developer->save();
            if ($request->has('arabic_description') && $request->arabic_description !== '') {
                $developer->addTranslation(['description' => $request->arabic_description]);
            }

            return response()->json(['message' => 'Success', 'data' => $developer->load('translation')]);
        }catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            if ($request->hasFile('logo')) {
                $developer->logo = $developer->updateImage($request->logo, $developer->logo);
            }

            $developer->slug = $developer->name = $request->name;
            if ($request->has('description') && $request->description !== '') {
                $developer->description = $request->description;
            }

            if ($request->has('arabic_description') && $request->arabic_description !== '') {
                $developer->updateTranslation(['description' => $request->arabic_description]);
            }

            $developer->save();

            return response()->json(['message' => 'Success', 'data' => $developer->load('translation')], 200);
        }catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Developer $developer)
    {
        try {
            $developer->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
