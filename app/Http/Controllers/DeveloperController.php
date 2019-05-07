<?php

namespace App\Http\Controllers;

use App\Developer;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.index')->with([
            'developers' => Developer::all(),
        ]);
    }

    public function show(Developer $developer)
    {
        $locations = Location::with('projects')->whereHas('projects', function ($query) use ($developer){
            $query->where('developer_id', $developer->id);
        })->get();

        return view('developer.show')->with([
            'developer' => $developer,
            'locations' => $locations
        ]);
    }
}
