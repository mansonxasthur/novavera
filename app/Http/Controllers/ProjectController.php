<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        return view('project.show')->with(['project' => $project->load(['developer', 'location'])]);
    }
}
