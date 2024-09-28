<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ingredients;
use App\Models\Inventory;
use App\Models\kitchen;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\stock;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class OrderController extends Controller
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
        if (is_null($this->user) || !$this->user->can('order.take')) {
            abort(403, 'Sorry You are Unauthorized Access To take any orders');
        }
        $tables = Table::where('status', 'empty')->get();
        $menuitem = MenuItem::where('status', 'active')->get();
        return view('Backend.order.take', compact('tables', 'menuitem'));
    }
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('order.take')) {
            abort(403, 'Sorry, you are unauthorized to take any orders.');
        }
        // $data=$request->all();
        // dd($request->all());
        DB::beginTransaction();

        try {
            // Add data to the Orders table
            $order = new Order();
            $order->table_id = $request->input('table_id');
            $order->status = 'pending';
            $order->total = 0; // Set the initial total to zero
            $order->save();

            // Add data to the OrderItems table
            foreach ($request->input('inputs') as $item) {
                // dd($item);
                $ingredients = Ingredients::where('menu_items_id', $item['menu_item_id'])->get(); //Menu ma k k  ingredients
                foreach ($ingredients as $ingredient) {
                    $stock = Inventory::where('name', $ingredient->name)->first();
                    if (!$stock || @$stock->qty < ((float)$ingredient->quantity * (float) $item['quantity'])) {
                        return redirect()->back()->with('error', $ingredient->name . ' isnt available or low in stock for no of quantity.')->withInput();
                    }
                }
                foreach ($ingredients as $ingredient) {
                    $stock = Inventory::where('name', $ingredient->name)->first();

                    $quantity = (float) $stock->qty - ((float)$ingredient->quantity * (float) $item['quantity']);
                    $stock->qty = $quantity;
                    $stock->update();
                }
                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->menu_item_id = $item['menu_item_id'];
                $order_item->quantity = $item['quantity'];
                $order_item->price = $item['price'];

                $order_item->save();
                // $oi=OrderItem::with('menuItem')->where('id',$order_item)->get();
                // $order_items[]=$oi;

                // Update the total in the Orders table
                $order->total += $item['price'];




                // assign food to kitchen Algorithm
            }
            // dd($oi);
            $tableid = $request->input('table_id');
            $table = Table::find($tableid);
            $table->status = 'full';
            $table->save();

            $order->save(); // Save the updated total
            $orderItems = OrderItem::with(['menuItem'])->where('order_id', $order->id)->get();
            $kitchen = kitchen::all();
            // $orderItemsQueue = $orderItems->toArray(); // Convert the collection to an array
            $kitchenUsage = [];
            // dd($orderItems);
            foreach ($orderItems as $orderItem) {

                // Check if this order item has been ordered before
                $existingOrderItem = OrderItem::with('kitchen')->where('menu_item_id', $orderItem->menu_item_id)
                    ->where('order_id', '<', $order->id) // Only consider previous orders
                    ->where('status', 'active') // Only consider previous orders
                    ->orderBy('order_id', 'desc') // Order by the most recent order first
                    ->first();
                // dd($existingOrderItem);

                if ($existingOrderItem) {
                    // dd($orderItems);

                    $orderItem['kitchen_id'] = $existingOrderItem->kitchen_id;
                    $orderItem->save();
                    //assign kitchen to same kitchen where
                } else {
                    // dd($orderItems);

                    foreach ($kitchen as $kitchens) {
                        // find if any of kitechen hasnt been used in order item
                        // $kitchen_find=OrderItem::with('kitchen')->where('kitchen_id','!=',$kitchens->id)->where('status','active')->first();
                        $kitchen_find = Kitchen::whereDoesntHave('orderItems', function ($query) {
                            $query->where('status', 'active');
                        })->first();
                        if ($kitchen_find) {
                            $orderItem['kitchen_id'] = $kitchen_find->id;
                            $orderItem->save();
                            break;
                            // dd($orderItem);

                        } else {

                            // $kitchen_find = Kitchen::whereHas('orderItems', function ($query) use ($order) {
                            //     $query->where('status', 'active')
                            //           ->where('order_id', '<', $order->id)
                            // ->orderBy('updated_at', 'asc');

                            // })
                            // ->get();
                            $kitchen_find = OrderItem::where('status', 'active')
                                ->where('order_id', '<', $order->id)
                                ->orderBy('updated_at', 'desc')
                                ->get();
                            // dd($kitchen_find);
                            if ($kitchen_find) {
                                $orderItem['kitchen_id'] = $kitchen_find->last()->id;
                                $orderItem->save();
                                break;
                                // dd($orderItem);

                            }
                        }
                    }
                }
                //             if ($existingOrderItem && isset($kitchenUsage[$existingOrderItem->kitchen_id])) {

                //                 // If the same item has been ordered before, assign it to the same kitchen
                //                 $orderItem['kitchen_id'] = $existingOrderItem->kitchen_id;
                //             } else {

                //                 // Otherwise, assign the order item to the least recently used kitchen
                //                 $kitchenid = $this->getLRUKitchen($kitchen, $kitchenUsage);
                // // dd($kitchenid);
                //                 $orderItem['kitchen_id'] = $kitchenid;
                //                 // $kitchenUsage[$kitchen->id] = time(); // Update the LRU timestamp
                //             }
                //         // dd($kitchenUsage);

                // $orderItem->save();
            }

            // Generate the PDF view data
            $data = [
                'order' => $order,
                'orderItems' => $orderItems,
            ];
            // dd($data);
            $pdf = PDF::loadView('pdf', compact('data'));
            $pdf->setPaper([0, 0, 226, 800], 'portrait');

            DB::commit(); // Commit the transaction
            return $pdf->stream('bill');

            return redirect()->route('order.view')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurs
            throw $e;
        }
    }
    public function ViewOrder()
    {
        if (is_null($this->user) || !$this->user->can('order.view')) {
            abort(403, 'Sorry You are Unauthorized to view any orders');
        }
        //dd(today_date());
        // Get today's date
        $today = Carbon::today()->toDateString();

        // Retrieve pending orders created today
        $pendingorders = Order::where('status', 'pending')
            ->with('table', 'orderItems.menuItem')
            ->orderBy('created_at', 'DESC')
            ->get();
        $completedorders = Order::where('status', 'completed')
            ->whereDate('created_at', $today)
            ->with('table', 'orderItems.menuItem')
            ->orderBy('created_at', 'DESC')
            ->get();
        //$completedorders=Order::where('status','completed')->whereDate('created_at',$today)->with('table', 'orderItems.menuItem')->orderBy('created_at','DESC')->get();
        //dd($pendingorders);
        return view('Backend.order.view', compact('pendingorders', 'completedorders'));
    }
    public function edit($id)
    {
        $orders = Order::with('table', 'orderItems.menuItem')->find($id);
        //dd($orders);
        $tables = Table::get();
        //dd($tables);
        $menuitem = MenuItem::where('status', 'active')->get();
        return view('Backend.order.edit', compact('tables', 'menuitem', 'orders'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('order.take')) {
            abort(403, 'Sorry, you are unauthorized to take any orders.');
        }
        // dump($request->all());
        DB::beginTransaction();
        try {
            $orders = $request->input('inputs', []);

            // Define a condition to filter out arrays with "orderitem_id"
            $newOrders = array_filter($orders, function ($item) {
                return !isset($item['orderitem_id']);
            });
            foreach ($newOrders as $item) {
                $order_item = new OrderItem();
                $order_item->order_id = $id;
                $order_item->menu_item_id = $item['menu_item_id'];
                $order_item->quantity = $item['quantity'];
                $order_item->price = $item['price'];
                $order_item->save();
                // Update the total in the Orders table
                $order = Order::find($id);
                $order->total += $item['price'];
                $order->save();
                $ingredients = Ingredients::where('menu_items_id', $item['menu_item_id'])->get();
                //Menu ma k k  ingredients
                foreach ($ingredients as $ingredient) {
                    $stock = Inventory::where('name', $ingredient->name)->first();
                    if (!$stock || @$stock->qty < ((float)$ingredient->quantity * (float) $item['quantity'])) {

                        return redirect()->back()->with('error', $ingredient->name . ' isnt available or low in stock for the no of quantity.')->withInput();
                    }
                }
                foreach ($ingredients as $ingredient) {
                    $stock = Inventory::where('name', $ingredient->name)->first();
                    // dd($stock);
                    $quantity = (float) $stock->qty - ((float)$ingredient->quantity * (float) $item['quantity']);
                    $stock->qty = $quantity;
                    $stock->update();
                }
                $kitchen_order = OrderItem::where('status', 'active')->where('id', '!=', $order_item->id)->where('menu_item_id', $item['menu_item_id'])->orderBy('order_id', 'desc')->first();
                // dd($kitchen_order);
                if ($kitchen_order) {
                    // dd('kitchen true');
                    $order_item->kitchen_id = $kitchen_order->kitchen_id;
                    $order_item->save();
                } else {
                    // dump('kitchen false');
                    $kitchenWorkload = OrderItem::where('id', '!=', $order_item->id)->select('kitchen_id', DB::raw('COUNT(*) as total_order_items'))->groupBy('kitchen_id')->get();

                    // Find the least busy kitchen.
                    $leastBusyKitchen = $kitchenWorkload->sortBy('total_order_items')->first();

                    if ($leastBusyKitchen->id != '') {
                        $order_item->kitchen_id = $leastBusyKitchen->id;
                        $order_item->save();
                    } else {
                        $busyKitchenIds = $kitchenWorkload->pluck('kitchen_id');
                        $freeKitchen = Kitchen::all()->pluck('id')->diff($busyKitchenIds)->first();
                        $order_item->kitchen_id = $freeKitchen;
                        $order_item->save();
                    }
                    // dd($freeKitchen, $kitchenWorkload, $leastBusyKitchen);
                }
            }
            $highestOrderItemId = 0; // Variable to store the highest orderitem_id

            // Filter arrays without orderitem_id and find the highest orderitem_id
            foreach ($orders as $data) {
                // dump($inputs, $data);
                if (isset($data['orderitem_id'])) {
                    // This array does not have "orderitem_id"

                    // If "orderitem_id" is set and it's greater than the current highest, update it
                    if (isset($data['orderitem_id']) && $data['orderitem_id'] > $highestOrderItemId) {
                        $highestOrderItemId = $data['orderitem_id'];
                    }
                }
            }
            $orderItems = OrderItem::with(['menuItem'])->where('order_id', $order->id)->where('id', '>', $highestOrderItemId)->get();
            // dd($highestOrderItemId, $orderItems);
            // Generate the PDF view data
            $data = [
                'order' => $order,
                'orderItems' => $orderItems,
            ];

            $pdf = PDF::loadView('pdf', compact('data'));
            $pdf->setPaper([0, 0, 226, 800], 'portrait');

            DB::commit(); // Commit the transaction
            return $pdf->stream('my.pdf',  array("Attachment" => false));

            return redirect()->route('order.view')->with('success', 'Order Updated successfully.');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurs
            throw $e;
        }
    }
    // order item deletion
    public function DeleteOrderItems(Request $request)
    {
        $orderItemId = $request->id;
        $orderItem = OrderItem::find($orderItemId);
        if ($orderItem) {
            $orderId = $orderItem->order_id;

            // Get the order
            $order = Order::find($orderId);

            if ($order) {
                // Subtract the deleted order item's price from the order's total
                $order->total -= $orderItem->price;
                $order->save();

                // Delete the order item
                $orderItem->delete();

                return response()->json(['success' => true, 'message' => 'Order item deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete order item. Order not found.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete order item. Order item not found.']);
        }
    }
    private function getLRUKitchen($kitchens, $kitchenUsage)
    {
        $oldestTimestamp = PHP_INT_MAX;
        $lruKitchen = null;
        foreach ($kitchens as $kitchen) {
            // dd($kitchen);

            if (!isset($kitchenUsage[$kitchen->id])) {
                return $kitchen->id; // If a kitchen hasn't been used before, assign it
            }

            if ($kitchenUsage[$kitchen->id]) {
                // if ($kitchenUsage[$kitchen->id] < $oldestTimestamp) {
                $oldestTimestamp = $kitchenUsage[$kitchen->id];
                $lruKitchen = $kitchen;
            }
        }

        return $lruKitchen;
    }
}
