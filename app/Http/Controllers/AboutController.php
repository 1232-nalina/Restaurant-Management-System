<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $About = About::orderBy('created_at','DESC')->get();
        return view('Backend.about.view',compact('About'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.about.add');
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
            'title' => 'required',
            'description' =>'required',
        ]);
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->hashName();
            $fileNameForImage = 'Image_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/About/';
            $file->move($path,$fileNameForImage);
        }else{
            $fileNameForImage = "noimg.jpg";
        }
        if($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $fileName = $file->hashName();
            $fileNameForBannerImage = 'Image1_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/About/';
            $file->move($path,$fileNameForBannerImage);
        }else{
            $fileNameForBannerImage = "noimg.jpg";
        }
        // dd($request->all());

        $About = new About();
        $About->title = $request->title;
        $About->meta_keyword = $request->meta_keyword;
        $About->meta_description = htmlspecialchars($request->get('meta_description'));
        $About->description = htmlspecialchars($request->get('description'));
        $About->mission = htmlspecialchars($request->get('mission'));
        $About->vision = htmlspecialchars($request->get('vision'));
        $About->values = htmlspecialchars($request->get('values'));
        $About->image = $fileNameForImage;
        $About->banner_image = $fileNameForBannerImage;
        $About->status = $request->status;
        $status = $About->save();
        if ($status) {
            return redirect()->route('about.index')->with('success', 'About Details added successfully');
        } else {
            dd($status);
            return redirect()->back()->with('error', 'problem in adding About Details');
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
        $About = About::find($id);
        //dd($client);
        return view('Backend.about.edit', compact('About'));
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
            'title' => 'required',
            'description' =>'required',
        ]);
        
        $About = About::find($id);
        if($request->hasFile('image')){
            $oldPath = public_path().'/upload/About/'.$About->image;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('image');
            $path = public_path().'/upload/About/';
            $fileName = $file->getClientOriginalName();
            $fileNameForImage = "Image_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForImage);
        }else{
            $fileNameForImage = $About->image;
        }


        if($request->hasFile('banner_image')){
            $oldPath = public_path().'/upload/About/'.$About->banner_image;
            if(\File::exists($oldPath)){
                \File::delete($oldPath);
            }
            $file = $request->file('banner_image');
            $path = public_path().'/upload/About/';
            $fileName = $file->getClientOriginalName();
            $fileNameForBannerImage = "Image1_".time().rand(1,1000).$fileName;
            $file->move($path,$fileNameForBannerImage);
        }else{
            $fileNameForBannerImage = $About->banner_image;
        }

        
        $About->title = $request->title;
        $About->meta_keyword = $request->meta_keyword;
        $About->meta_description = htmlspecialchars($request->get('meta_description'));
        $About->description = htmlspecialchars($request->get('description'));
        $About->mission = htmlspecialchars($request->get('mission'));
        $About->vision = htmlspecialchars($request->get('vision'));
        $About->values = htmlspecialchars($request->get('values'));
        $About->image = $fileNameForImage;
        $About->banner_image = $fileNameForBannerImage;
        $About->status = $request->status;
        $status = $About->save();
        if ($status) {
            return redirect()->route('about.index')->with('success', 'About Details Updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Updating System Setting');
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
        $About = About::find($id);
        $status = $About->delete();
        if ($status) {
            return redirect()->route('about.index')->with('success', 'About Details Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting About Details');
        }
    }
}

