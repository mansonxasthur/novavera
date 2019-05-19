<?php

namespace App\Http\Controllers;

use App\Citizenship;
use Illuminate\Http\Request;

class CitizenshipController extends Controller
{
    public function show(string $type, Citizenship $citizenship)
    {
        if (!in_array($type, ['citizenship', 'residency'])) abort(404);

        return view('citizenship.show')->with([
            'citizenship' => $citizenship,
            'citizenships' => Citizenship::where('type', $type)->where('id', '<>', $citizenship->id)->get()
        ]);
    }
}
