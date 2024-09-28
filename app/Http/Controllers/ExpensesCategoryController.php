<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesCategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('expenses_category.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any expenses_category');
        }
        // $category = ExpenseCategory::all();
        $category = $this->user->expenses_category()->get();
        //dd($client);
        return view('Backend.expenses_category.view', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('expenses_category.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any Expenses Category');
        }
        return view('Backend.expenses_category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('expenses_category.create')) {
            abort(403, 'Sorry, you are unauthorized to create any Expenses Category.');
        }
    
        $request->validate([
            'inputs.*.category_name' => 'required|max:200',
            
        ], [
            'inputs.*.category_name.required' => 'Expenses Category is required.',
            
        ]);
    
        $statuses = [];
        foreach ($request->inputs as $input) {
            $status = ExpenseCategory::create([
                'admin_id' => Auth::id(),
                'category_name' => $input['category_name'],
              
            ]);
            $statuses[] = $status;
        }
    
        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding Expenses Categories.');
        } else {
            return redirect()->route('expenses_category.index')->with('success', 'Expenses categories added successfully.');
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
        if (is_null($this->user) || !$this->user->can('expenses_category.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Expenses Category');
        }
        $expenses_category = ExpenseCategory::find($id);
        //dd($client);
        return view('Backend.expenses_category.edit', compact('expenses_category'));
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
           if (is_null($this->user) || !$this->user->can('expenses_category.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Expenses Category');
        }
        $request->validate([
            'category_name' => 'required|max:200',
          
          
        ]);

        $expenses_category = ExpenseCategory::find($id);
        //dd($expenses_category);
        $expenses_category->category_name = $request->category_name;
        $expenses_category->status = $request->status;
        $status = $expenses_category->save();
        if ($status) {
            return redirect()->route('expenses_category.index')->with('success', 'expenses category updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in updating expenses_category');
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
        if (is_null($this->user) || !$this->user->can('expenses_category.delete')) {
            abort(403, 'Sorry You are Unauthorized Access To Delete any Expenses Category');
        }
        $expenses_category = ExpenseCategory::find($id);
        $status = $expenses_category->delete();
        if ($status) {
            return redirect()->route('expenses_category.index')->with('success', 'Expenses Category Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Expenses Category');
        }
    }
}
