<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function store(Request $request)
    {
    //dd($request->all());
    if (is_null($this->user) || !$this->user->can('payment.make')) {
        abort(403, 'Sorry You are Unauthorized to make any payments');
    }

    $paymentType = $request->input('paymentType');
    $cashAmount = $request->input('cashAmount');
    $changeAmount = $request->input('changeAmount');
    $orderId = $request->input('orderId');
    $amount = $request->input('amount');
    $prefix = 'TXN_';
    $transactionId = $prefix . uniqid();
    $table_id=$request->input('table_id');

    $payment=new Payment();
    $payment->order_id=$orderId;
    $payment->amount=$amount;
    $payment->payment_method=$paymentType;
    $payment->transaction_id=$transactionId;
    $payment->cashamount=$cashAmount;
    $payment->changeamount=$changeAmount;
    $payment->status='completed';
    $payment->save();
    //update the table status after payment success
    $tablestatus=Table::find($table_id);
    $tablestatus->status='empty';
    $tablestatus->save();
    //update the order status to completed after payment success
    $orderstatus=Order::with('orderItems')->find($orderId);
    // dd($orderstatus);
    foreach($orderstatus->orderItems as $os){
        $ot=OrderItem::find($os->id);
        $ot->status='inactive';
        $ot->update();
    }
    $orderstatus->status='completed';
    $orderstatus->save();

    // Return a response indicating the payment status
    return response()->json(['status' => 'success', 'message' => 'Payment saved successfully']);
    }
}
