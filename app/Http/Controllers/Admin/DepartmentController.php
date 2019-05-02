<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Facades\Logger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        return view('admin.department.index', ['departments' => Department::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $department = Department::create(['name' => $request->name]);

            return response()->json(['message' => 'Success', 'data' => $department], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $department->update(['name' => $request->name]);

            return response()->json(['message' => 'Success', 'data' => $department], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
