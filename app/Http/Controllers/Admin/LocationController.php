<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Facades\Logger;
use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function index() {
        return view('admin.location.index', ['locations' => Location::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'translation.name' => 'required'
        ]);

        try {
            $location = Location::create(['name' => $request->name]);
            $location->addTranslation(['name' => $request->translation['name']]);

            return response()->json(['message' => 'Success', 'data' => $location->load('translation')], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'translation.name' => 'required'
        ]);

        try {
            $location->update(['name' => $request->name]);
            $location->updateTranslation(['name' => $request->translation['name']]);

            return response()->json(['message' => 'Success', 'data' => $location->load('translation')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
