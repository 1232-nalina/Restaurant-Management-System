<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\stock;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
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
        if (is_null($this->user) || !$this->user->can('stock.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any stock');
        }

        //dd($client);
        $stock=stock::all();
        // dd($stock);
       return view('Backend.stock.view',compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('stock.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any stock');
        }
        $data=Ingredients::all();
        return view('Backend.stock.add',compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('stock.create')) {
            abort(403, 'Sorry, you are unauthorized to create any stocks.');
        }
        $stockData = $request->all();
// dd($stockData);
        $request->validate([
              'inputs.*.name' => 'required|string|',
            'inputs.*.quantity' => 'required|integer',
                'inputs.*.amount' => 'required|numeric',

        ], [
            'inputs.*.name.required' => 'enter a stock name',
            'inputs.*.quantity.required' => 'enter a quantity name',
            'inputs.*.amount.required' => 'enter a amount name',
        ]);

        $statuses = [];
        foreach ($stockData['inputs'] as $data) {
            if (is_array($data) && isset($data['name'])) {
                // dd('hi');
                $stock = new Stock;
                $stock->name = $data['name'];
                $stock->quantity_in_gm = $data['quantity'];
                $stock->amount = $data['amount'];
                $stock->save();

                $statuses[] = $stock;
            }
        }

        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding stock.');
        } else {
            return redirect()->route('stock.index')->with('success', 'stock added successfully.');
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
        if (is_null($this->user) || !$this->user->can('stock.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any stocks.');
        }
        $stock=stock::findOrfail($id);
        return view("Backend.stock.edit",compact(['stock']));
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
        if (is_null($this->user) || !$this->user->can('stock.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any stocks.');
        }
        $data=$request->all();
        // dd($data);
        $rules = [
            'name' => 'required|string|max:100',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',

        ];
        $message =[
        'name.required' => 'enter a stock name',
        'quantity.required' => 'enter a quantity name',
        'amount.required' => 'enter a amount name',

        ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $stock=stock::findOrfail($id);
        $stock->name=$request->stock;
        $stock->quantity_in_gm=$request->quantity;
        $stock->amount=$request->amount;
        $stock->update();

        return redirect()->route('stock.index')->with('success', 'stock updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('stock.delete')) {
            abort(403, 'Sorry, you are unauthorized to create any stocks.');
        }
        $stock=stock::findOrfail($id);
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'stock deleted successfully.');

    }
}
