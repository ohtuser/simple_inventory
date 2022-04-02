<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function purchaseCreate(){
        return view('transaction.purchase.create');
    }

    public function store(Request $request){
        return $request->all();

        $request->validate([
            'vendor' => 'required',
            'date' => 'required',
            'g_total' => 'required'
        ]);

        $invoice_info = [
            'transaction_type' => $request->transaction_type,
            'date' => date('Y-m-d', strtotime($request->date)),
            'party_id' => $request->vendor,
            'invoice_no' => generateInvoice(1)
        ];


        $table->timestamp('date')->nullable();
                $table->unsignedBigInteger('party_id')->nullable();
                $table->string('invoice_no')->nullable();
                $table->unsignedBigInteger('ref_invoice')->nullable();
                $table->string('ref_invoice_model')->nullable();
                $table->string('manual_ref_invoice')->nullable();
                $table->string('bill_no')->nullable();
                $table->date('bill_no_date')->nullable();
                $table->double('grand_total')->default(0);
                $table->double('discount')->default(0);
                $table->double('net_total')->default(0);
                $table->double('payable')->default(0);
                $table->double('pay')->default(0);
                $table->double('due')->default(0);
                $table->string('attachment')->nullable();
                $table->string('note')->nullable();
                $table->tinyInteger('status')->default(1)->comment('1=active, 2=inactive');
    }
}
