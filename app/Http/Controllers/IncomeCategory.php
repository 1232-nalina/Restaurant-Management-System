<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Domain;
use App\Models\IncomeCategory as ModelsIncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeCategory extends Controller
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
        if (is_null($this->user) || !$this->user->can('income_category.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any income_category');
        }
        $category = $this->user->income()->get();
        //dd($client);
        return view('Backend.income_category.view', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('income_category.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any income source');
        }
        return view('Backend.income_category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    if (is_null($this->user) || !$this->user->can('income_category.create')) {
        abort(403, 'Sorry, you are unauthorized to create any income source.');
    }

    $request->validate([
        'inputs.*.category_name' => 'required|max:200',
        'inputs.*.income_amount' => 'required',
    ], [
        'inputs.*.category_name.required' => 'Income Source is required.',
        'inputs.*.income_amount.required' => 'Income Amount is required.',
    ]);

    $statuses = [];
    foreach ($request->inputs as $input) {
        $status = ModelsIncomeCategory::create([
            'admin_id' => Auth::id(),
            'category_name' => $input['category_name'],
            'income_amount' => $input['income_amount'],
            
        ]);
        $statuses[] = $status;
    }

    if (in_array(false, $statuses)) {
        return redirect()->back()->with('error', 'Problem in adding income categories.');
    } else {
        return redirect()->route('income_category.index')->with('success', 'Income categories added successfully.');
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
        if (is_null($this->user) || !$this->user->can('income_category.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Income Source');
        }
        $income_category = ModelsIncomeCategory::find($id);
        //dd($client);
        return view('Backend.income_category.edit', compact('income_category'));
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
        //dd($request->all());
        if (is_null($this->user) || !$this->user->can('income_category.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Income Source');
        }
        $request->validate([
            'category_name' => 'required|max:200',
            'income_amount' => 'required',
          
        ]);

        $income_category = ModelsIncomeCategory::find($id);
        //dd($income_category);
        $income_category->category_name = $request->category_name;
        $income_category->income_amount = $request->income_amount;
     
        $income_category->status = $request->status;
        $status = $income_category->save();
        if ($status) {
            return redirect()->route('income_category.index')->with('success', 'income_category updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in updating income_category');
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
        if (is_null($this->user) || !$this->user->can('income_category.delete')) {
            abort(403, 'Sorry You are Unauthorized Access To Delete any income source');
        }
        $income_category = ModelsIncomeCategory::find($id);
        $status = $income_category->delete();
        if ($status) {
            return redirect()->route('income_category.index')->with('success', 'Income Source Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Income Source');
        }
    }
}
