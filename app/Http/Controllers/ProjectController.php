<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        return view('project')->with(['project' => $project]);
    }
}
