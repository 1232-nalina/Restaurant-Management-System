<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ExpensesController extends Controller
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
        if (is_null($this->user) || !$this->user->can('expenses.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any expenses');
        }
        $currentFullMonth = Carbon::now()->format('F');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $expenses =  $this->user->expenses()->with('expenses_cat')->orderBy('expenses_date','DESC')->get();
        $expenses_monthly = $this->user->expenses()->whereMonth('expenses_date', $currentMonth)
                    ->whereYear('expenses_date', $currentYear)
                    ->get();
        $totalMonthlyExpenses = $expenses_monthly->sum('amount');
        //dd($expenses);
        return view('Backend.expenses.view', compact('expenses','totalMonthlyExpenses','currentMonth','currentFullMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('expenses.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Add any Expenses');
        }
        $expenses_category = $this->user->expenses_category()->pluck('id', 'category_name');
        //dd($client);
        return view('Backend.expenses.add', compact('expenses_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('expenses.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Add any Domain');
        }
        $request->validate(
            [
                'category_id' => 'required',
                'expenses_date' => 'required',
                'amount' => 'required',

            ],
            ['expenses_date.required' => 'Please select an expenses date.',    'amount.required' => 'Please enter an expenses amount.']

        );
        $expenses = new Expenses();
        $expenses->category_id = $request->category_id;
        $expenses->expenses_date = $request->expenses_date;
        $expenses->amount = $request->amount;
        $expenses->admin_id = Auth::id();

        $status = $expenses->save();
        if ($status) {
            return redirect()->route('expenses.index')->with('success', 'expenses added successfully');
        } else {
            return redirect()->back()->with('error', 'problem in adding expenses');
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
        if (is_null($this->user) || !$this->user->can('expenses.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Expenses');
        }
        $expenses = Expenses::find($id);
        $expenses_category = $this->user->expenses_category()->pluck('id', 'category_name');
        //dd($expenses_category);
        return view('Backend.expenses.edit', compact('expenses','expenses_category'));
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
          if (is_null($this->user) || !$this->user->can('expenses.edit')) {
            abort(403, 'Sorry You are Unauthorized Access To Edit any Expenses');
        }
        $request->validate([
            'category_id' => 'required',
            'amount' => 'required',
            'expenses_date' => 'required',
          
          
        ]);

        $expenses = Expenses::find($id);
        //dd($expenses);
        $expenses->category_id = $request->category_id;
        $expenses->amount = $request->amount;
        $expenses->expenses_date = $request->expenses_date;
        $expenses->status = $request->status;
        $status = $expenses->save();
        if ($status) {
            return redirect()->route('expenses.index')->with('success', 'expenses updated successfully');
        } else {
            return redirect()->back()->with('error', 'problem in updating expenses');
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
        if (is_null($this->user) || !$this->user->can('expenses.delete')) {
            abort(403, 'Sorry You are Unauthorized Access To Delete any Expenses');
        }
        $expenses = Expenses::find($id);
        $status = $expenses->delete();
        if ($status) {
            return redirect()->route('expenses.index')->with('success', 'Expenses Deleted successfully');
        } else {
            return redirect()->back()->with('error', 'problem in Deleting Expenses');
        }
    }

    public function GenerateExpensesReport(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('expenses.report')) {
            abort(403, 'Sorry, you are unauthorized to access any expenses report.');
        }
        
        $year = $request->input('year');
        $month = $request->input('month');
        //dd($month);
    
        // Retrieve expenses for the specified year and month from your data source
        $expenses = $this->user->expenses()->whereYear('expenses_date', $year)
            ->whereMonth('expenses_date', $month)
            ->with('expenses_cat')
            ->get();
            $totalExpenses = $expenses->sum('amount');
            //dd($totalExpenses);

            // retrive the total income
            $totalIncome = $this->user->income()->sum('income_amount');

            // calculation saving for the month 

            $totalSavings = $totalIncome - $totalExpenses;
    
            return redirect()->route('expenses.report.view', compact('totalExpenses','year','month','totalSavings'))->with('expenses', $expenses);
    }
    
    public function ExpensesReportView(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('expenses.report')) {
            abort(403, 'Sorry, you are unauthorized to access any expenses report.');
        }
    
        $expenses = session('expenses');
    $year = $request->input('year');
    $month = $request->input('month');
    $totalExpenses = $request->input('totalExpenses');
    $totalSavings = $request->input('totalSavings');
    // Convert the month number to a textual representation
    $monthName = date('F', mktime(0, 0, 0, $month, 1));
    $yearName = date('Y', strtotime($year . '-01-01'));

    return view('Backend.expenses.reportview', compact('expenses', 'year', 'month', 'monthName','yearName','totalExpenses','totalSavings'));
    }

    public function ChangePasswordPage()
    {
        return view('Backend.changepassword-page');
    }
    public function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ]);
        $user = Auth::user();

        // checking if the current password is correct 

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Your current password is incorrect.Please check again');
        }

        // updating the user's new password
        $user->password = Hash::make($request->new_password);
        $user->password_changed=1;
        $user->latitude=$request->latitude;
        $user->longitude=$request->longitude;
        $user->save();

        return redirect()->route('admin.login')->with('success', 'Password updated successfully.Please login again');

    }
    
}
