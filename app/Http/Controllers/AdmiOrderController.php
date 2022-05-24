<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdmiOrderController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with('getOrderDetails', 'orderedBy', 'deliveredBy')->get();
        return view('admin_order.index', $data);
    }

    public function cancel(Request $request)
    {
        Order::find($request->id)->update(['status' => 3, 'order_cancel_charge' => $request->order_cancel_charge]);
        return back();
    }
}
