<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\PropertyRequest;
use Illuminate\Http\Request;

class PropertyRequestController extends Controller
{
    public function index()
    {
        return view('admin.propertyRequest.index')->with(['propertyRequests' => PropertyRequest::all()]);
    }

    public function destroy(PropertyRequest $propertyRequest)
    {
        try {
            $propertyRequest->delete();

            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
