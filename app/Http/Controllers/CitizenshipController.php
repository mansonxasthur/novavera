<?php

namespace App\Http\Controllers;

use App\Citizenship;
use App\ConsultationRequest;
use App\Facades\Logger;
use App\Mail\FreeConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CitizenshipController extends Controller
{
    public function show(string $type, Citizenship $citizenship)
    {
        if (!in_array($type, ['citizenship', 'residency'])) abort(404);

        return view('citizenship.show')->with([
            'citizenship' => $citizenship,
            'citizenships' => Citizenship::where('type', $type)->where('id', '<>', $citizenship->id)->get(),
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required',
        ]);

        $consultation = new ConsultationRequest(
            $request->name,
            $request->email,
            $request->phone
        );


        try {
            Mail::to('info@novavera.com')->send(new FreeConsultation($consultation));

            return response()->json(['message' => __('sentences.requestFormMessage')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => __('sentences.requestFormError')], 500);
        }
    }
}
