<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Department;
use App\Facades\Logger;
use App\Mail\NewApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    public function index()
    {
        return view('careers')->with(['departments' => Department::all()]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required',
            'department' => 'required|exists:departments,id',
            'cv' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $applicant = new Applicant;
        $applicant->name = $request->name;
        $applicant->department_id = $request->department;
        $applicant->email = $request->email;
        $applicant->phone = $request->phone;

        if ($request->has('linkedIn') && $request->linkedIn !== null)
            $applicant->linkedin_link = $request->linkedIn;

        $applicant->cv = $applicant->uploadFile($request->cv);

        try {
            $applicant->save();

            Mail::to('careers@novavera.com')->send(new NewApplicant($applicant));

            return response()->json(['message' => __('sentences.careersFormMessage')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => __('sentences.careersFormError')], 500);
        }
    }
}
