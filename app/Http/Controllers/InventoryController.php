<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Inventory = Inventory::orderBy('created_at', 'DESC')->get();
        return view('Backend.inventory.view', compact('Inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Ingredients::all();
// dd($data);
        return view('Backend.inventory.add',compact('data'));
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
            'qty' => 'required',
            'status' => 'required|in:active,inactive',
        ]);


        $Inventory = new Inventory();
        $Inventory->name = $request->name;
        $Inventory->qty = $request->qty;
        $Inventory->price = $request->price;
        $Inventory->unit = $request->unit;
        $Inventory->status = $request->status;
        $status =   $Inventory->save();
        if ($status) {
            return redirect()->route('inventories.index')->with('success', 'Inventories added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding Inventories');
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
        $Inventory = Inventory::find($id);
        $data=Ingredients::all();
        return view('Backend.inventory.edit', compact('Inventory'));
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
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'status' => 'required|in:active,inactive',
        ]);


        $Inventory = Inventory::find($id);
        if ($request->filled('g_in')) {
            // dd($request->g_in);
            $qty = $Inventory->qty + $request->g_in;
            $Inventory->qty = $qty;
        // } elseif ($request->filled('g_out')) {
        //     // dd($request->g_out);
        //     $qty = $Inventory->qty - $request->g_out;
        //     $Inventory->qty = $qty;
        }
        else{
            $Inventory->qty = $request->qty;
        }
        $Inventory->name = $request->name;
        $Inventory->price = $request->price;
        $Inventory->unit = $request->unit;
        $Inventory->status = $request->status;
        $status =   $Inventory->save();

        if ($status) {
            return redirect()->route('inventories.index')->with('success', 'Inventory Updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Updating Inventory');
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
        $Inventory = Inventory::find($id);
        $status = $Inventory->delete();
        if ($status) {
            return redirect()->route('inventories.index')->with('success', 'Inventory Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Inventory');
        }
    }
}
