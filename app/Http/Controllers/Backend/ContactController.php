<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ContactDetails = Contact::orderBy('created_at', 'DESC')->get();
        return view('Backend.contact.view', compact('ContactDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.contact.add');
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
            'address' => 'required',
            'email' => 'required',
            'phone_one' => 'required',
            'logo' => 'required',
            'facebook_link' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->hashName();
            $fileNameForLogoImage = 'Image_' . time() . rand(1, 1000) . $fileName;
            $path = public_path() . '/upload/Contact/';
            $file->move($path, $fileNameForLogoImage);
        } else {
            $fileNameForLogoImage = "noimg.jpg";
        }
        if ($request->hasFile('fab_icon')) {
            $file = $request->file('fab_icon');
            $fileName = $file->hashName();
            $fileNameForFabImage = 'Image1_' . time() . rand(1, 1000) . $fileName;
            $path = public_path() . '/upload/Contact/';
            $file->move($path, $fileNameForFabImage);
        } else {
            $fileNameForFabImage = "noimg.jpg";
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = $file->hashName();
            $fileNameForBannerImage = 'Image2_' . time() . rand(1, 1000) . $fileName;
            $path = public_path() . '/upload/Contact/';
            $file->move($path, $fileNameForBannerImage);
        } else {
            $fileNameForBannerImage = "noimg.jpg";
        }
        $ContactDetails = new Contact();
        $ContactDetails->address = $request->get('address');
        $ContactDetails->email = $request->get('email');
        $ContactDetails->phone_one = $request->get('phone_one');
        $ContactDetails->phone_two = $request->get('phone_two');
        $ContactDetails->google_map = $request->get('google_map');
        $ContactDetails->facebook_link = $request->get('facebook_link');
        $ContactDetails->twitter_link = $request->get('twitter_link');
        $ContactDetails->gmail_link = $request->get('gmail_link');
        $ContactDetails->instagram_link = $request->get('instagram_link');
        $ContactDetails->logo = $fileNameForLogoImage;
        $ContactDetails->fab_icon = $fileNameForFabImage;
        $ContactDetails->banner_image = $fileNameForBannerImage;
        $status = $ContactDetails->save();
        if ($status) {
            return redirect()->route('contact.index')->with('success', 'Contact Details added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding Contact Details');
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
        $ContactDetails = Contact::find($id);
        //dd($client);
        return view('Backend.contact.edit', compact('ContactDetails'));
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
            'address' => 'required',
            'email' => 'required',
            'phone_one' => 'required',
            'facebook_link'=>'required'
        ]);
        
        $ContactDetails = Contact::find($id);
        if($request->hasFile('logo')){
            $oldPath = public_path().'/upload/Contact/'.$ContactDetails->logo;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('logo');
            $path = public_path().'/upload/Contact/';
            $fileName = $file->getClientOriginalName();
            $fileNameForLogoImage = "Image_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForLogoImage);
        }else{
            $fileNameForLogoImage = $ContactDetails->logo;
        }
        if($request->hasFile('fab_icon')){
            $oldPath = public_path().'/upload/Contact/'.$ContactDetails->fab_icon;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('fab_icon');
            $path = public_path().'/upload/Contact/';
            $fileName = $file->getClientOriginalName();
            $fileNameForFabImage = "Image1_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForFabImage);
        }else{
            $fileNameForFabImage = $ContactDetails->fab_icon;
        }

        if($request->hasFile('banner_image')){
            $oldPath = public_path().'/upload/Contact/'.$ContactDetails->banner_image;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('banner_image');
            $path = public_path().'/upload/Contact/';
            $fileName = $file->getClientOriginalName();
            $fileNameForBannerImage = "Image2_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForBannerImage);
        }else{
            $fileNameForBannerImage = $ContactDetails->banner_image;
        }
        
        $ContactDetails->address = $request->get('address');
        $ContactDetails->email = $request->get('email');
        $ContactDetails->phone_one = $request->get('phone_one');
        $ContactDetails->phone_two = $request->get('phone_two');
        $ContactDetails->google_map = $request->get('google_map');
        $ContactDetails->facebook_link = $request->get('facebook_link');
        $ContactDetails->twitter_link = $request->get('twitter_link');
        $ContactDetails->gmail_link = $request->get('gmail_link');
        $ContactDetails->instagram_link = $request->get('instagram_link');
        $ContactDetails->logo = $fileNameForLogoImage;
        $ContactDetails->fab_icon = $fileNameForFabImage;
        $ContactDetails->banner_image = $fileNameForBannerImage;
        $status = $ContactDetails->save();
        if ($status) {
            return redirect()->route('contact.index')->with('success', 'Contact Details Updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Updating Contact Details');
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
        $ContactDetails = Contact::find($id);
        $status = $ContactDetails->delete();
        if ($status) {
            return redirect()->route('contact.index')->with('success', 'Conatct Details Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Contact Details');
        }
    }
}
