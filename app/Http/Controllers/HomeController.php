<?php

namespace App\Http\Controllers;

use App\Developer;
use App\Location;
use App\Project;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::main()->first();
        $developers = Developer::all();
        $residentialProjectLocations = Location::whereHas('projects', function ($query) {
            $query->where('project_type', 'residential')
                ->orWhere('project_type', 'both');
        })
            ->with(['projects' => function ($query) {
                $query->where('project_type', 'residential')
                    ->orWhere('project_type', 'both');
            }])
            ->get();

        $commercialProjectLocations = Location::whereHas('projects', function ($query) {
            $query->where('project_type', 'commercial')
                ->orWhere('project_type', 'both');
        })
            ->with(['projects' => function ($query) {
                $query->where('project_type', 'commercial')
                    ->orWhere('project_type', 'both');
            }])
            ->get();

        return view('home', compact(['projects', 'slider', 'developers', 'residentialProjectLocations', 'commercialProjectLocations']));
    }
}
