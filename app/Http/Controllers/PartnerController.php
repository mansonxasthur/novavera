<?php

namespace App\Http\Controllers;

use App\Mail\NewPartner;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PartnerController extends Controller
{
    public function index()
    {
        return view('partners');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required',
            'companyName' => 'required',
            'jobTitle' => 'required',
            'message' => 'required',
        ]);

        $partner = new Partner(
            $request->name,
            $request->email,
            $request->phone,
            $request->companyName,
            $request->jobTitle,
            $request->message
        );


        try {
            Mail::to('pr@novavera.com')->send(new NewPartner($partner));

            return response()->json(['message' => 'Request has been received we will contact you shortly'], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failed to submit your application please try again later'], 500);
        }
    }
}
