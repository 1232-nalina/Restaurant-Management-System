<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuCategoryController extends Controller
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
        $menucategory=MenuCategory::all();
        //dd($menucategory);
       return view('Backend.menucategory.view',compact('menucategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('menucategory.create')) {
            abort(403, 'Sorry you are unauthorized to create any menucategory');
        }

        return view('Backend.menucategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('menucategory.create')) {
            abort(403, 'Sorry, you are unauthorized to create any menucategory.');
        }

        $request->validate([
            'inputs.*.name' => 'required|max:200',
            'inputs.*.type' => 'required',

        ], [
            'inputs.*.name.required' => 'enter a menucategory name',
            'inputs.*.name.type' => 'enter a menucategory type',

        ]);
       

        $statuses = [];
        foreach ($request->inputs as $input) {
            $status = MenuCategory::create([
                'name' => $input['name'],
                'type' => $input['type'],
             
            ]);
            $statuses[] = $status;
        }
       

        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding menucategory.');
        } else {
            return redirect()->route('menucategory.index')->with('success', 'menucategory added successfully.');
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
        if (is_null($this->user) || !$this->user->can('menucategory.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To View any menucategory');
        }

        $menucategory=MenuCategory::findOrfail($id);
        return view('Backend.menucategory.edit',compact('menucategory'));
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
        if (is_null($this->user) || !$this->user->can('menucategory.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To View any menucategory');
        }
        $data=$request->all();

        $rules = [
            'menu_category_name' => 'required|string|unique:tables,name|max:100',
            'type' => 'required|string',
            // 'menu_category_name' => 'required|string|unique:tables,name|max:100',

        ];
        $message = [
            'menu_category_name.required' => ' name is required.',
            'type.required' => ' type is required.',
            'menu_category_name.unique' => 'Menu Category name has been taken.',
            'menu_category_name.max' => 'Menu Category name max length is 100 '
            ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $menucategory=MenuCategory::findOrfail($id);
        $menucategory->name=$request->menu_category_name;
        $menucategory->type=$request->type;
        $menucategory->update();

       return redirect()->route('menucategory.index')->with('success', 'Menu category updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('menucategory.delete')) {
            abort(403, 'Sorry You are Unauthorized Access To View any menucategory');
        }
        $menucategory=MenuCategory::findOrfail($id);
        $menucategory->delete();

        return redirect()->route('menucategory.index')->with('success', 'Menu category deleted successfully.');

    }
}
