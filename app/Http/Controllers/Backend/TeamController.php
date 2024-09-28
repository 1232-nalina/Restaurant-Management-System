<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMember = Team::orderBy('created_at','DESC')->get();
        return view('Backend.team.view',compact('teamMember'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.team.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'facebook_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->hashName();
            $fileNameForImage = 'Image_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/Team/';
            $file->move($path,$fileNameForImage);
        }else{
            $fileNameForImage = "noimg.jpg";
        }

        $teamMember = new Team();
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        $teamMember->phone = $request->phone;
        $teamMember->email = $request->email;
        $teamMember->description = $request->description;
        $teamMember->facebook_link = $request->facebook_link;
        $teamMember->insta_link = $request->insta_link;
        $teamMember->linkedin_link = $request->linkedin_link;
        $teamMember->twitter_link = $request->twitter_link;
        $teamMember->image = $fileNameForImage;
        $teamMember->status = $request->status;
        $status =   $teamMember->save();
        if ($status) {
            return redirect()->route('team.index')->with('success', 'Team Member added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding Team Member');
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
        $teamMember = Team::find($id);
        return view('Backend.team.edit', compact('teamMember'));
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
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'facebook_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);
        
        $teamMember = Team::find($id);
        if($request->hasFile('image')){
            $oldPath = public_path().'/upload/Team/'.$teamMember->image;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('image');
            $path = public_path().'/upload/Team/';
            $fileName = $file->getClientOriginalName();
            $fileNameForImage = "Image_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForImage);
        }else{
            $fileNameForImage = $teamMember->image;
        }  
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        $teamMember->facebook_link = $request->facebook_link;
        $teamMember->insta_link = $request->insta_link;
        $teamMember->linkedin_link = $request->linkedin_link;
        $teamMember->twitter_link = $request->twitter_link;
        $teamMember->image = $fileNameForImage;
        $teamMember->status = $request->status;
        $status =   $teamMember->save();

        if ($status) {
            return redirect()->route('team.index')->with('success', 'Team Member Updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Updating Team Member');
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
        $teamMember = Team::find($id);
        $status = $teamMember->delete();
        if ($status) {
            return redirect()->route('team.index')->with('success', 'Team Member Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Team Member');
        }
    }
}