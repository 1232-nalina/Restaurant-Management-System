<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    // old frontend
    // public function index()
    // {
    //     $menucategory=MenuCategory::with('menuItems')->get();
    //     return view ('frontend-index',compact('menucategory'));
    // }
    public function index(){
        // dd('hi');
        $Team = Team::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        $menus = MenuItem::where('status','active')->latest()->get();
        $menus_categories = MenuCategory::all();
        // dd($menus);
        return view('Frontend.home', compact('Team', 'menus','menus_categories'));

    }
    public function redirects(){
        $usertype= Auth::user()->usertype;
        if($usertype=='1')
    	{
    		return view('frontend.admin.adminhome');
    	}
        else{
            return view('frontend.home');
        }
    }
    public function Team()
    {
        $Team = Team::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        return view('frontend.team', compact('Team'));
    }
    public function Menu()
    {
        $Menubreakfast = MenuCategory::with('MenuItem')->where('type','breakfast')->orderBy('created_at', 'ASC')->get();
        $Menulunch = MenuCategory::with('MenuItem')->where('type','lunch')->orderBy('created_at', 'ASC')->get();
        $Menuall = MenuItem::orderBy('created_at', 'ASC')->get();
        // $Menuall = MenuCategory::with('MenuItem')->orderBy('created_at', 'ASC')->distinct()->get();
        $Menudinner = MenuCategory::with('MenuItem')->where('type','dinner')->orderBy('created_at', 'ASC')->get();
        $Menudrink = MenuCategory::with('MenuItem')->where('type','drink')->orderBy('created_at', 'ASC')->get();
        $menus = MenuItem::where('status','active')->latest()->get();
        $menus_categories = MenuCategory::all();
        $Team = Team::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        // $MenuItem = MenuItem::orderBy('created_at', 'ASC')->get();
        // dd($Menuall);

        return view('frontend.menu', compact('Menubreakfast','Menulunch','Menuall','Menudinner','Menudrink','menus','menus_categories','Team'));
    }
    public function About()
    {
        $About = About::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        return view('frontend.about', compact('About'));
    }
}
