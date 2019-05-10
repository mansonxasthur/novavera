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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index')->with(['projects' => Project::with('developer', 'location')->get()]);
    }

    public function create()
    {
        return view('admin.project.create')->with([
            'developers'    => Developer::all(),
            'locations'     => Location::all(),
            'propertyTypes' => PropertyType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                    => 'required',
            'developer'               => 'required',
            'propertyTypes'           => 'required',
            'projectType'             => 'required',
            'location'                => 'required',
            'lat'                     => 'required',
            'lng'                     => 'required',
            'description'             => 'required',
            'translation.name'        => 'required',
            'translation.description' => 'required'
        ]);

        try {
            $project = Project::installation($request);

            $project->addTranslation([
                'name'        => $request->translation['name'],
                'description' => $request->translation['description'],
            ]);

            if ($request->has('images')) {
                $uploadedImages = $request->images;

                if (is_array($uploadedImages) && !empty($uploadedImages)) {
                    $images = [];
                    foreach ($uploadedImages as $image) {
                        if ($image->isValid()) {
                            $images[] = ['path' => $project->uploadImage($image)];
                        }
                    }

                    $project->images()->createMany($images);
                }
            }


            $propertyTypes = json_decode($request->propertyTypes);
            if (!empty($propertyTypes)) {
                if (is_object($propertyTypes[0])) {
                    $propertyTypes = collect($propertyTypes)->map(function ($type) {
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
            'developers'    => Developer::all(),
            'locations'     => Location::all(),
            'propertyTypes' => PropertyType::all(),
            'project'       => $project->load([
                'developer', 'location'
            ])
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'                    => 'required',
            'developer'               => 'required',
            'propertyTypes'           => 'required',
            'projectType'             => 'required',
            'location'                => 'required',
            'lat'                     => 'required',
            'lng'                     => 'required',
            'description'             => 'required',
            'translation.name'        => 'required',
            'translation.description' => 'required'
        ]);

        try {
            if ($project->updateInstallation($request)) {
                $project->updateTranslation([
                    'name'        => $request->translation['name'],
                    'description' => $request->translation['description'],
                ]);

                if ($request->has('images')) {
                    $uploadedImages = $request->images;

                    if (is_array($uploadedImages) && !empty($uploadedImages)) {
                        $images = [];
                        foreach ($uploadedImages as $image) {
                            if ($image->isValid()) {
                                $images[] = ['path' => $project->uploadImage($image)];
                            }
                        }

                        $project->images()->createMany($images);
                    }
                }


                $propertyTypes = json_decode($request->propertyTypes);
                if (!empty($propertyTypes)) {
                    if (is_object($propertyTypes[0])) {
                        $propertyTypes = collect($propertyTypes)->map(function ($type) {
                            return $type->id;
                        });
                    }

                    $project->propertyTypes()->sync($propertyTypes);
                }

                if (!empty($request->deletedImages)) {
                    $images = json_decode($request->deletedImages);

                    Image::destroy($images);
                }
            }


            return response()->json(['message' => 'Success', 'slug' => $project->slug], 200);
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
