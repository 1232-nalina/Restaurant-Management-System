<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        //dd($users);
        return view('Backend.user.view',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('Backend.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validate data
         $request->validate([
            'name'=>'required|max:50',
            'email'=>'required|max:100|email|unique:users',
            'password'=>'required|max:100|min:8|confirmed',
        ],[
            'name.required' => 'please give a user name',
            'name.email' => 'please give user email'
        ]);
        // create new user
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $status=$user->save();

        //asign roles to this user
        if($request->roles)
        {
            $user->assignRole($request->roles);
        }

        if ($status) {
            return redirect()->route('users.index')->with('success', 'User Created Successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'Error in Creating User');
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
        $user=User::find($id);
        $roles=Role::all();
        return view('Backend.user.edit',compact('user','roles'));

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
           //validate data
           $request->validate([
            'name'=>'required|max:50',
            'email'=>'required|max:100|email|unique:users,email,' .$id,
            'password'=>'nullable|min:8|confirmed',
        ],[
            'name.required' => 'please give a user name',
            'name.email' => 'please give user email'
        ]);
        // create new user
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password)
        {
        $user->password=Hash::make($request->password);
    }
        $status=$user->save();
        $user->roles()->detach();
        //asign roles to this user
        if($request->roles)
        {
            $user->assignRole($request->roles);
        }

        if ($status) {
            return redirect()->route('users.index')->with('success', 'User Updated Successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'Error in Updated User');
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
        $user=User::find($id);
        if(!is_null($user))
        {
            $status=$user->delete();
            if ($status) {
                return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
            } else {
                return redirect()->route('users.index')->with('error', 'Error in Deleting User');
            }
        }
    }
    public function logout()
    {
    Auth::logout();
    return redirect()->route('login');
    }
}
