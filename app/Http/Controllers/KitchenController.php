<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kitchen;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KitchenController extends Controller
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
        if (is_null($this->user) || !$this->user->can('kitchen.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any kitchen');
        }

        //dd($client);
        $kitchen=kitchen::all();
        $data = OrderItem::with('menuItem')->get();
        // dd($kitchen);
       return view('Backend.kitchen.view',compact('kitchen','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('kitchen.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any kitchen');
        }
        return view('Backend.kitchen.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('kitchen.create')) {
            abort(403, 'Sorry, you are unauthorized to create any kitchens.');
        }

        $request->validate([
            'inputs.*.name' => 'required|max:200|unique:kitchen,name',

        ], [
            'inputs.*.name.required' => 'enter a kitchen name',
            'inputs.*.name.unique' => 'kitchen name already taken',
        ]);

        $statuses = [];
        foreach ($request->inputs as $input) {
            $status = kitchen::create([
                'name' => $input['name'],
            ]);
            $statuses[] = $status;
        }

        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding kitchen.');
        } else {
            return redirect()->route('kitchen.index')->with('success', 'kitchen added successfully.');
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
        if (is_null($this->user) || !$this->user->can('kitchen.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any kitchens.');
        }
        $kitchen=kitchen::findOrfail($id);
        return view("Backend.kitchen.edit",compact(['kitchen']));
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
        if (is_null($this->user) || !$this->user->can('kitchen.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any kitchens.');
        }
        $data=$request->all();

        $rules = [
            'kitchen' => 'required|string|unique:kitchen,name|max:100',

        ];
        $message = [
            'kitchen.required' => 'kitchen name is required.',
            'kitchen.unique' => 'kitchen name has been taken.',
            'kitchen.max' => 'kitchen name max length is 100 '
            ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $kitchen=kitchen::findOrfail($id);
        $kitchen->name=$request->kitchen;
        $kitchen->update();

        return redirect()->route('kitchen.index')->with('success', 'kitchen updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('kitchen.delete')) {
            abort(403, 'Sorry, you are unauthorized to create any kitchens.');
        }
        $kitchen=kitchen::findOrfail($id);
        $kitchen->delete();
        return redirect()->route('kitchen.index')->with('success', 'kitchen deleted successfully.');

    }
}
