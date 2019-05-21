<?php

namespace App\Http\Controllers\Admin;

use App\Applicant;
use App\Http\Controllers\Controller;
use App\PropertyRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home')->with([
            'propertyRequests' => PropertyRequest::whereDate('created_at', date('Y-m-d', time()))->count(),
            'applicants' => Applicant::whereDate('created_at', date('Y-m-d', time()))->count(),
        ]);
    }
}
