<?php

namespace App\Http\Controllers;

use App\Facades\Logger;
use App\Location;
use App\Mail\NewRequest;
use App\PropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyRequestController extends Controller
{
    public function index()
    {
        return view('property-request')->with(['locations' => Location::with('projects')->get()]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required',
            'project' => 'required|exists:projects,id',
            'property' => 'required|exists:property_types,id',
            'message' => 'required'
        ]);

        $propertyRequest = new PropertyRequest();
        $propertyRequest->name = $request->name;
        $propertyRequest->email = $request->email;
        $propertyRequest->phone = $request->phone;
        $propertyRequest->project_id = $request->project;
        $propertyRequest->property_id = $request->property;
        $propertyRequest->message = $request->message;


        try {
            $propertyRequest->save();

            Mail::to('sales@novavera.com')->send(new NewRequest($propertyRequest));

            return response()->json(['message' => 'Request has been received we will contact you shortly'], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failed to submit your request please try again later'], 500);
        }
    }
}
