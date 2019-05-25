<?php

namespace App\Http\Controllers;

use App\Location;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(string $projectType)
    {
        $locations = Location::whereHas('projects', function ($query) use ($projectType) {
            $query->where('project_type', $projectType)
                ->orWhere('project_type', 'both');
        })
            ->with(['projects' => function ($query) use ($projectType) {
                $query->where('project_type', $projectType)
                    ->orWhere('project_type', 'both');
            }])
            ->get();

        $title = $projectType . 'Projects';
        return view('project.index', compact(['locations', 'title']));
    }

    public function show(string $projectType, Project $project)
    {
        return view('project.show')->with(['project' => $project->load(['developer', 'location'])]);
    }
}
