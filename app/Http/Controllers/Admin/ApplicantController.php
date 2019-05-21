<?php

namespace App\Http\Controllers\Admin;

use App\Applicant;
use App\Facades\Logger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('admin.applicant.index')->with(['applicants' => Applicant::all()]);
    }

    public function show(Applicant $applicant)
    {
        return view('admin.applicant.show', compact('applicant'));
    }

    public function shortlist(Request $request, Applicant $applicant)
    {
        $request->validate([
            'shortlist' => 'required'
        ]);

        try {
            $applicant->update([
                'shortlist' => $request->shortlist,
            ]);
            return response('', 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response('', 500);
        }
    }

    public function reject(Request $request, Applicant $applicant)
    {
        $request->validate([
            'rejected' => 'required'
        ]);

        try {
            $applicant->update([
                'rejected' => $request->rejected,
            ]);
            return response('', 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response('', 500);
        }
    }

    public function destroy(Applicant $applicant)
    {
        try {
            $applicant->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
