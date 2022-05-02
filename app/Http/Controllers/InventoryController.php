<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function purchaseCreate(){
        return view('transaction.purchase.create');
    }

    public function store(Request $request){
        // return $request->all();

        $request->validate([
            'vendor' => 'required',
            'date' => 'required',
            'g_total' => 'required'
        ]);

        $invoice_info = [
            'date' => date('Y-m-d', strtotime($request->date)),
            'party_id' => $request->vendor,
            'invoice_no' => generateInvoice(1),
            'ref_invoice' => null,
            'ref_invoice_model' => null,
            'manual_ref_invoice'=> null,
            'bill_no' => $request->bill_no,
            'bill_no_date' => date('Y-m-d', strtotime($request->bill_date)),
            'transaction_type' => $request->transaction_type,
            'date' => date('Y-m-d', strtotime($request->date)),
            'grand_total' => 100,
            'discount' => 100,
            'net_total' => 1,
            'payable' => 1,
            'pay' => 3,
            'due' => 4,
            'attachment' => null,
            'note' => null,
            'status' => 1
        ];

        Invoice::create($invoice_info);
        return 1;
    }
}
