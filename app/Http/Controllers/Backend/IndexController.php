<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Expenses;
use App\Models\Hosting;
use App\Models\HostingCategory;
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Get the current date

class IndexController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {

        //dd($expiring_hosting);

        // if (is_null($this->user) || !$this->user->can('dashboard.view')) {
        //     abort(403, 'Sorry You are Unauthorized Access To View Dashboard');
        // }

        $year = date('Y'); // Get the current year

        $expensesData = $this->user->expenses()
            ->select(DB::raw('MONTH(expenses_date) as month'), DB::raw('SUM(amount) as total_amount'))
            ->whereYear('expenses_date', $year) // Filter by current year
            ->groupBy('month')
            ->get();

        $currentMonth =cur_month();

        $totalIncome = $this->user->income()
        ->sum('income_amount');

        $totalExpenses = $this->user->expenses()
        ->whereMonth('expenses_date', $currentMonth)
        ->sum('amount');

        //dd($totalExpenses);

    // Prepare data for chart
    $months = [];
    $amounts = [];

    foreach ($expensesData as $data) {
        $monthName = date('F', mktime(0, 0, 0, $data->month, 1));
        $months[] = $monthName;
        $amounts[] = $data->total_amount;


    }
    $inventorykg=Inventory::where('unit','kg')->where('qty','<',10)->get();
    $inventoryltr=Inventory::where('unit','litre')->where('qty','<',20)->get();
    $inventorypcs=Inventory::where('unit','pcs')->where('qty','<',50)->get();
    // $inventory = Inventory::groupBy('unit')->get();
    $currentDate = Carbon::now()->toDateString();


    $records = Reservation::whereDate('date', '>=', $currentDate)
    ->orderByRaw('date = ? desc', [$currentDate])
    ->orderBy('date', 'asc')
    ->get();

        $kitchenWorkload = OrderItem::select(
            'menu_item_id',
            DB::raw('COUNT(*) as total_menu_items')
        )->groupBy('menu_item_id')->with('menuItem')->get();

        // Find the least busy kitchen.
        $trends = $kitchenWorkload->take(10);
        // dd($trends);
        return view('Backend.dashboard.index', compact('months', 'amounts', 'totalExpenses', 'totalIncome', 'inventorykg', 'inventoryltr', 'inventorypcs', 'records', 'trends'));
    }
}
