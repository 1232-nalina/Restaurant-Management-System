<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any Role');
        }
        $all_roles_in_database = Role::all();
        //dd($all_roles_in_database);

        return view('Backend.role.view', compact('all_roles_in_database'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Add any Role');
        }
        $all_permission_in_database = Permission::all();
        $permission_groups = User::getpermissionGroups();
        //dd($permission_groups);
        //dd($all_permission_in_database);
        return view('Backend.role.add', compact('all_permission_in_database', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry You are Unauthorized To Add any Role');
        }
        //validate data
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.required' => 'please give a role name',
            'name.unique' => 'this role is already created'
        ]);
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);

        $permission = $request->input('permission');

        if (!empty($permission)) {
            $role->syncPermissions($permission);
        }

        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Role Added Successfully');
        } else {
            return redirect()->route('roles.index')->with('error', 'Error in Creating Roles');
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry You are Unauthorized To Edit any Role');
        }
        $role = Role::findById($id, 'admin');
        $all_permission_in_database = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('Backend.role.edit', compact('role', 'all_permission_in_database', 'permission_groups'));
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry You are Unauthorized To Edit any Role');
        }
        //validate data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.required' => 'please give a role name',

        ]);
        $role = Role::findById($id, 'admin');

        $permission = $request->input('permission');

        if (!empty($permission)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permission);
        }



        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Role Updated Successfully');
        } else {
            return redirect()->route('roles.index')->with('error', 'Error in Updating Roles');
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
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'Sorry You are Unauthorized To Delete any Role');
        }
        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $status = $role->delete();
            if ($status) {
                return redirect()->route('roles.index')->with('success', 'Role Deleted Successfully');
            } else {
                return redirect()->route('roles.index')->with('error', 'Error in Deleting Roles');
            }
        }
    }
}
