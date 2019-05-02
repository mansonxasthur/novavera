<?php

namespace App\Http\Controllers\Admin;

use App\Developer;
use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\Image;
use App\Location;
use App\Project;
use App\PropertyType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index')->with(['projects' => Project::all()]);
    }

    public function create()
    {
        return view('admin.project.create')->with([
            'developers' => Developer::all(),
            'locations' => Location::all(),
            'propertyTypes' => PropertyType::all(),
        ]);
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'arabicName' => 'required',
            'developer' => 'required',
            'propertyTypes' => 'required',
            'projectType' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'description' => 'required',
            'arabicDescription' => 'required'
        ]);

        try {
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
            $project->save();

            $project->addTranslation([
               'name' => $request->arabicName,
               'description' => $request->arabicDescription,
            ]);

            $uploadedImages = $request->images;
            if (!empty($uploadedImages)){
                $images = [];
                foreach($uploadedImages as $image){
                    $images[] = ['path' => $project->uploadImage($image)];
                }

                $project->images()->createMany($images);
            }

            $propertyTypes = json_decode($request->propertyTypes);
            if (!empty($propertyTypes)){
                if (is_object($propertyTypes[0])) {
                    $propertyTypes = collect($propertyTypes)->map(function($type) {
                        return $type->id;
                    });
                }

                $project->propertyTypes()->sync($propertyTypes);
            }

            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function edit(Project $project)
    {
        return view('admin.project.edit')->with([
            'developers' => Developer::all(),
            'locations' => Location::all(),
            'propertyTypes' => PropertyType::all(),
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'arabicName' => 'required',
            'developer' => 'required',
            'propertyTypes' => 'required',
            'projectType' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'description' => 'required',
            'arabicDescription' => 'required'
        ]);

        try {
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
                $project->logo = $project->updateImage($request->logo, $project->logo);
            }
            $project->save();
            $project->updateTranslation([
                'name' => $request->arabicName,
                'description' => $request->arabicDescription,
            ]);

            $uploadedImages = $request->images;
            if (!empty($uploadedImages)){
                $images = [];
                foreach($uploadedImages as $image){
                    $images[] = ['path' => $project->uploadImage($image)];
                }

                $project->images()->createMany($images);
            }

            $propertyTypes = json_decode($request->propertyTypes);
            if (!empty($propertyTypes)){
                if (is_object($propertyTypes[0])) {
                    $propertyTypes = collect($propertyTypes)->map(function($type) {
                       return $type->id;
                    });
                }

                $project->propertyTypes()->sync($propertyTypes);
            }

            if (!empty($request->deletedImages)){
                $images = json_decode($request->deletedImages);

                Image::destroy($images);
            }

            return response()->json(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
