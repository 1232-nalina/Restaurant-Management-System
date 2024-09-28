<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\MenuItem;

class CartController extends Controller
{
    public function index(Request $request){
        $menus = MenuItem::all();
        // dd($menus);
        return view("frontend.cartpage",compact("menus"));
    }
    public function addtocart(Request $request){
        return view("frontend.addtocart");
}
    public function checkout(Request $request){
        return view("frontend.checkout");
}
    public function thanku(Request $request){
        return view("frontend.thanku");
}
}