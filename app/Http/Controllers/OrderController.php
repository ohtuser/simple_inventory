<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with('getOrderDetails')->where('party_id', user()->id)->get();
        return view('order.index', $data);
    }

    public function create()
    {
        $data['categories'] = ProductCategory::whereHas('getSubCategory.getProductsSubCatWise')->with(
            'getSubCategory.getProductsSubCatWise.getBrand',
            'getSubCategory.getProductsSubCatWise.getUnit',
            'getSubCategory.getProductsSubCatWise.getStock'
        )->where('parent', null)->get();

        // return $data;
        return view('order.create', $data);
    }

    public function store(Request $request)
    {
        $added_product = array_filter($request->product_qty);
        if (count($added_product) <= 0) {
            return response()->json(['message' => 'No Product Added'], 421);
        } else {
            $order = Order::create([
                'party_id' => user()->id,
                'order_number' => getOrderNumber()
            ]);
            foreach ($added_product as $product => $qty) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product,
                    'qty' => $qty
                ]);
            }

            return response()->json(requestSuccess('Order Done', '', 'close', 1000, ''), 200);
        }
    }
}
