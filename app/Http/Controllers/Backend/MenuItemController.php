<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ingredients;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuItemController extends Controller
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
        if (is_null($this->user) || !$this->user->can('menucategory.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any menucategory');
        }

        //dd($client);
        $menuitem=MenuItem::where('status','active')->with('menucategory')->get();
        $menucategory=MenuCategory::with('MenuItem')->get();
        //dd($menucategory);
       // dd($menuitem);
       return view('Backend.menuitem.view',compact('menuitem','menucategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('menuitem.create')) {
            abort(403, 'Sorry you are unauthorized to create any menu item');
        }
        $menucategory=MenuCategory::all();
        //dd($menucategory);
        return view('Backend.menuitem.add',compact('menucategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('menuitem.create')) {
            abort(403, 'Sorry, you are unauthorized to create any menuitem.');
        }
        $data=$request->all();
        // dd($request);
        $request->validate([
            'menu_cat_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'inputs.*.ingredients_name' => 'required|max:200',
            'inputs.*.quantity' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'description'=>'required',


        ], [
            'menu_cat_id.required' => 'choose menu category',
            'name.required' => 'menu item name is required',
            'description.required' => 'description is required',
            'price.required' => 'enter item price',
            'inputs.*.ingredients_name.required' => 'enter a Ingredients name',
            'inputs.*.quantity.required' => 'enter a Quantity name',
            'image.image' => 'Image must be image',
            'image.required' => 'Image is required',

        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->hashName();
            $fileNameForImage = 'Image_'.time().rand(1,1000).$fileName;
            $path = public_path().'/upload/Menu/';
            $file->move($path,$fileNameForImage);
        }


        $statuses = [];
        $menu=new MenuItem();
        $menu->menu_cat_id=$request['menu_cat_id'];
        $menu->name=$request['name'];
        $menu->price=$request['price'];
        $menu->description=$request['description'];
        $menu->image=$fileNameForImage;
        $menu->save();

        foreach ($request->inputs as $input) {
            // dd('hi');
            $Ingredients = new Ingredients();
            $Ingredients->menu_items_id=$menu->id;
            $Ingredients->name=$input['ingredients_name'];
            $Ingredients->quantity=$input['quantity'];
            $Ingredients->unit=$input['unit'];
            $Ingredients->save();

            $statuses[] = $Ingredients;
        }


        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding menuitem.');
        } else {
            return redirect()->route('menuitem.index')->with('success', 'menuitem added successfully.');
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
        if (is_null($this->user) || !$this->user->can('menuitem.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any menuitem.');
        }
        $menucategory=MenuCategory::all();
        $menuitem=MenuItem::with('menucategory')->findOrfail($id);
        // dd($menuitem);
        $ingredients=Ingredients::where('menu_items_id',$id)->get();
        return view('Backend.menuitem.edit',compact('menuitem','menucategory','ingredients'));


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
        if (is_null($this->user) || !$this->user->can('menuitem.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any menuitem.');
        }
        $data=$request->all();
        // dd($request);
        $request->validate([
            'menu_category_name' => 'required',
            'Menu_Item_Name' => 'required',
            'description'=>'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'inputs.*.ingredients_name' => 'required|max:200',
            'inputs.*.quantity' => 'required|max:200',

        ], [
            'image.image' => 'Image must be image',
            'description.required' => 'Description is required',
            'menu_category_name.required' => 'choose menu category',
            'Menu_Item_Name.required' => 'menu item name is required',
            'price.required' => 'enter item price',
            'inputs.*.ingredients_name.required' => 'enter a Ingredients name',
            'inputs.*.quantity.required' => 'enter a Quantity name',


        ]);
// dd('hi');
if($request->hasFile('image')){
    $file = $request->file('image');
    $fileName = $file->hashName();
    $fileNameForImage = 'Image_'.time().rand(1,1000).$fileName;
    $path = public_path().'/upload/Menu/';
    $file->move($path,$fileNameForImage);
}
        $menuitem=MenuItem::findOrfail($id);

        $menuitem->menu_cat_id = $request['menu_category_name'];
        $menuitem->name = $request['Menu_Item_Name'];
        $menuitem->price = $request['price'];
        $menuitem->image = $fileNameForImage ?? $menuitem->image;
        $menuitem->description=$request['description'];
        $menuitem->update();
        $request_input=[];
        $get_ingredients=Ingredients::where('menu_items_id',$id)->pluck('id')->toArray();

        foreach ($request->inputs as $input) {
            // dd($input);
            if (array_key_exists('ingredients_id', $input)) {
            $request_input[]=$input['ingredients_id'];

            $Ingredients = Ingredients::find($input['ingredients_id']);
            // dd($Ingredients);
            $Ingredients->menu_items_id=$menuitem->id;
            $Ingredients->name=$input['ingredients_name'];
            $Ingredients->quantity=$input['quantity'];
            $Ingredients->unit=$input['unit'];
            $Ingredients->update();
            }else{
                // dd($input);
                $Ingredients = new Ingredients();
                $Ingredients->menu_items_id=$menuitem->id;
                $Ingredients->name=$input['ingredients_name'];
                $Ingredients->quantity=$input['quantity'];
            $Ingredients->unit=$input['unit'];
                $Ingredients->save();
                // dd($Ingredients);
                // dd($Ingredients->id);

            }
            $statuses[] = $Ingredients;
        }

        $diff=array_diff($get_ingredients,$request_input);
        // dd($diff);
        if ($diff){
            foreach($diff as $value){
                $del_ingredients=Ingredients::find($value);
                $del_ingredients->delete();
            }
        }
        // return redirect()->route('menuitem.index')->with('success', 'menuitem updated successfully.');

        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding menuitem.');
        } else {
            return redirect()->route('menuitem.index')->with('success', 'menuitem updated successfully.');
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
        // dd('hi');
        if (is_null($this->user) || !$this->user->can('menuitem.delete')) {
        abort(403, 'Sorry, you are unauthorized to create any menuitem.');
    }
        $menuitem=MenuItem::findOrfail($id);
        $menuitem->delete();
        return redirect()->route('menuitem.index')->with('success', 'Menuitem deleted successfully.');

    }
}
