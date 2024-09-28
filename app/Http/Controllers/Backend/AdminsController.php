<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any Admin');
        }
        $admin = Admin::all();
        //dd($admin);
        return view('Backend.admin.view', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any Admin');
        }
        $roles = Role::all();
        return view('Backend.admin.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any Admin');
        }
        //validate data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admin',
            'username' => 'required|max:100|unique:admin',
            'password' => 'required|max:100|min:8|confirmed',
        ], [
            'name.required' => 'please give a admin name',
            'name.email' => 'please give admin email'
        ]);
        // create new admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->latitude = $request->latitude;
        $admin->longitude = $request->longitude;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $status = $admin->save();

        //asign roles to this admin
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        if ($status) {
            return redirect()->route('admin.index')->with('success', 'admin Created Successfully');
        } else {
            return redirect()->route('admin.index')->with('error', 'Error in Creating admin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Admin');
        }
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('Backend.admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Admin');
        }
        //validate data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admin,email,' . $id,
            // 'username'=>'required|max:100|unique:admin',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'please give a admin name',
            'name.email' => 'please give admin email'
        ]);
        // create new admin
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->latitude = $request->latitude;
        $admin->longitude = $request->longitude;
        $admin->username = $request->username;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $status = $admin->save();
        $admin->roles()->detach();
        //asign roles to this admin
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        if ($status) {
            return redirect()->route('admin.index')->with('success', 'admin Updated Successfully');
        } else {
            return redirect()->route('admin.index')->with('error', 'Error in Updated admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry You are Unauthorized Access To Delete any Admin');
        }
        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $status = $admin->delete();
            if ($status) {
                return redirect()->route('admin.index')->with('success', 'admin Deleted Successfully');
            } else {
                return redirect()->route('admin.index')->with('error', 'Error in Deleting admin');
            }
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function getAllUsers()
    {
          // Retrieve all admin data from the database
          $admins = Admin::whereNotNull('latitude')->whereNotNull('longitude')->get();
          // Return the admin data as JSON response
          return response()->json($admins);
    }
}
