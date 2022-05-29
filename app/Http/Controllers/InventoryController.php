<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceTransaction;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    // ================================= common =================================
    public function store(Request $request)
    {
        $request->validate([
            'party' => 'required',
            'date' => 'required',
            'g_total' => 'required',
            'product' => 'required'
        ]);

        if ($request->order_id) {
            $order_info = Order::find($request->order_id);
            if ($order_info->delivery_type == 1) {
                $request->validate([
                    'deliveryman' => 'required'
                ]);
                $order_info->update(['delivered_by' => $request->deliveryman]);
            }
        }

        $product_array = array_filter($request->product, 'strlen');
        $qty_array = array_filter($request->qty, 'strlen');
        $price_array = array_filter($request->price, 'strlen');
        if ((count($product_array) != count($qty_array)) || (count($product_array) != count($price_array))) {
            return response()->json([
                'message' => 'Some Information Is Missing',
            ], 421);
        }


        try {
            DB::beginTransaction();
            $invoice_status = Invoice::invoiceStore($request);
            InvoiceTransaction::transactionStore($invoice_status, $request);
            journalPosting($invoice_status->id, $request->party, $request->in_out == 1 ? 2 : 1, $request->pay_amount, $request->date);
            DB::commit();
            return response()->json(requestSuccess('Invoice Created Successfully', '', route('transaction.print', ['id' => $invoice_status->id]), 1000, ''), 200);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function printInvoice(Request $request)
    {
        $data['inv'] = Invoice::with('get_transactions.product.getUnit', 'get_transactions.product.getStock', 'get_party')->findOrFail($request->id);
        $data['content'] = getInvoiceSettings($data['inv']->transaction_type);
        return view('transaction.common.print_invoice', $data);
    }

    //================================= purchase =================================
    public function purchaseCreate()
    {
        return view('transaction.purchase.create');
    }

    public function purchaseList()
    {
        $data['list'] = Invoice::with('get_party')->where('transaction_type', 1)->paginate(15);
        return view('transaction.purchase.list', $data);
    }

    //================================= purchase return =================================
    public function purchaseReturnCreate()
    {
        return view('transaction.purchase_return.create');
    }

    public function purchaseReturnList()
    {
        $data['list'] = Invoice::with('get_party')->where('transaction_type', 2)->paginate(15);
        return view('transaction.purchase_return.list', $data);
    }

    //================================= sell =================================
    public function sellCreate(Request $request)
    {
        if ($request->order_id) {
            $order = Order::with('getOrderDetails.getProduct.getUnit', 'getOrderDetails.getProduct.getStock')->findOrfail($request->order_id);
            return view('transaction.sell.create', compact('order'));
        }
        return view('transaction.sell.create');
    }

    public function sellList()
    {
        $data['list'] = Invoice::with('get_party')->where('transaction_type', 3)->paginate(15);
        return view('transaction.sell.list', $data);
    }

    //================================= sell return =================================
    public function sellReturnCreate()
    {
        return view('transaction.sell_return.create');
    }

    public function sellReturnList()
    {
        $data['list'] = Invoice::with('get_party')->where('transaction_type', 4)->paginate(15);
        return view('transaction.sell_return.list', $data);
    }
}
