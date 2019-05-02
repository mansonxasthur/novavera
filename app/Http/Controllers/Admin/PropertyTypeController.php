<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Facades\Logger;
use App\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index() {
        return view('admin.propertyType.index', ['propertyTypes' => PropertyType::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $propertyType = PropertyType::create(['name' => $request->name]);

            return response()->json(['message' => 'Success', 'data' => $propertyType], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $propertyType->update(['name' => $request->name]);

            return response()->json(['message' => 'Success', 'data' => $propertyType], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(PropertyType $propertyType)
    {
        try {
            $propertyType->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
