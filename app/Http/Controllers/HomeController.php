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
        return view('home')->with([
            'slider' => Slider::main()->first(),
            'developers' => Developer::all(),
            'projects' => Location::has('projects')->with('projects')->get()
        ]);
    }
}
