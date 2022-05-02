<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function purchaseCreate()
    {
        return view('transaction.purchase.create');
    }

    public function store(Request $request)
    {
        return $request->all();

        $request->validate([
            'vendor' => 'required',
            'date' => 'required',
            'g_total' => 'required'
        ]);

        // $invoice_info = [
        //     'transaction_type' => $request->transaction_type,
        //     'date' => date('Y-m-d', strtotime($request->date)),
        //     'party_id' => $request->vendor,
        //     'invoice_no' => generateInvoice(1)
        // ];
        return Invoice::invoiceStore($request);
    }
}
