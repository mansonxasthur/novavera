<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Facades\Logger;
use App\Notifications\AdminCreated;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.index')->with([
            'roles' => Role::where('id', '<>', 1)->get(),
            'admins' => Admin::with('role')->where('id', '<>', auth()->id())->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required | string',
            'email' => 'required | email |unique:admins,email',
            'role_id'  => 'required | integer |exists:roles,id'
        ]);


        try {
            $password = Str::random(8);

            $admin = Admin::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'role_id'  => $request->role_id,
                'password' => bcrypt($password)
            ]);

            $admin->notify(new AdminCreated($admin, $password));

            return response()->json(['message' => 'Success', 'data' => $admin->load('role')]);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin $admin
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'  => 'required | string',
            'email' => 'required | email |unique:admins,email,' . $admin->id,
            'role_id'  => 'required | integer |exists:roles,id'
        ]);


        try {
            $admin->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'role_id'  => $request->role_id,
            ]);


            return response()->json(['message' => 'Success', 'data' => $admin->load('role')]);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admin $admin
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}
