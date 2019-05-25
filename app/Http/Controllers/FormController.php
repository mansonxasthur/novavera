<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Facades\Logger;
use App\Inquiry;
use App\Mail\ContactMessaged;
use App\Mail\ProjectInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function home(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required',
            'inquiry_type' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact(
            $request->name,
            $request->email,
            $request->phone,
            $request->inquiry_type,
            $request->message
        );

        try {
            Mail::to('info@novavera.com')->send(new ContactMessaged($contact));

            return response()->json(['message' => __('sentences.homeContactFormMessage')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => __('sentences.homeContactFormError')], 500);
        }
    }

    public function project(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'project' => 'required',
            'location' => 'required',
            'message' => 'required',
        ]);

        $inquiry = new Inquiry(
            $request->name,
            $request->email,
            $request->project,
            $request->location,
            $request->message
        );

        try {
            Mail::to('info@novavera.com')->send(new ProjectInquiry($inquiry));

            return response()->json(['message' => __('sentences.inquiryFormMessage')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => __('sentences.inquiryFormError')], 500);
        }
    }
}
