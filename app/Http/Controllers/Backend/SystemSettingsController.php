<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $system_settings = SystemSettings::all();
        return view('Backend.systemsetting.view',compact('system_settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.systemsetting.add');
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
            'name' => 'required|max:200',
            'address' => 'required',
            'email' => 'required|email',
            'pan' => 'required|max:9',
            'phone' => 'required',
        ]);
        
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $fileName = $file->hashName();
            $fileNameForLogoImage = 'Image_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/System/';
            $file->move($path,$fileNameForLogoImage);
        }else{
            $fileNameForLogoImage = "noimg.jpg";
        }
        if($request->hasFile('signature')){
            $file = $request->file('signature');
            $fileName = $file->hashName();
            $fileNameForSignatureImage = 'Image1_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/System/';
            $file->move($path,$fileNameForSignatureImage);
        }else{
            $fileNameForSignatureImage = "noimg.jpg";
        }

        $system_settings = new SystemSettings();
        $system_settings->name = $request->name;
        $system_settings->address = $request->address;
        $system_settings->logo = $fileNameForLogoImage;
        $system_settings->signature = $fileNameForSignatureImage;
        $system_settings->pan = $request->pan;
        $system_settings->email = $request->email;
        $system_settings->phone = $request->phone;
        $status = $system_settings->save();
        if ($status) {
            return redirect()->route('systemsetting.index')->with('success', 'System Setting added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding System Setting');
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
        $system_settings = SystemSettings::find($id);
        //dd($client);
        return view('Backend.systemsetting.edit', compact('system_settings'));
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
            'name' => 'required|max:200',
            'address' => 'required',
            'email' => 'required|email',
            'pan' => 'required|max:9',
            'phone' => 'required',
        ]);
        
        $system_settings = SystemSettings::find($id);
        if($request->hasFile('logo')){
            $oldPath = public_path().'/upload/System/'.$system_settings->logo;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('logo');
            $path = public_path().'/upload/System/';
            $fileName = $file->getClientOriginalName();
            $fileNameForLogoImage = "Image_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForLogoImage);
        }else{
            $fileNameForLogoImage = $system_settings->logo;
        }


        if($request->hasFile('signature')){
            $oldPath = public_path().'/upload/System/'.$system_settings->signature;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('signature');
            $path = public_path().'/upload/Contact/';
            $fileName = $file->getClientOriginalName();
            $fileNameForSignatureImage = "Image1_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForSignatureImage);
        }else{
            $fileNameForSignatureImage = $system_settings->signature;
        }

        
        $system_settings->name = $request->name;
        $system_settings->address = $request->address;
        $system_settings->logo = $fileNameForLogoImage;
        $system_settings->signature = $fileNameForSignatureImage;
        $system_settings->pan = $request->pan;
        $system_settings->email = $request->email;
        $system_settings->phone = $request->phone;
        $system_settings->status = $request->status;
        $status = $system_settings->save();
        if ($status) {
            return redirect()->route('systemsetting.index')->with('success', 'System Setting added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding System Setting');
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
        $system_settings = SystemSettings::find($id);
        $status = $system_settings->delete();
        if ($status) {
            return redirect()->route('systemsetting.index')->with('success', 'System Settings Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting System Settings');
        }
    }
}
