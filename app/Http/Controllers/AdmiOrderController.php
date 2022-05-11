<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdmiOrderController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with('getOrderDetails', 'orderedBy')->get();
        return view('admin_order.index', $data);
    }
}
