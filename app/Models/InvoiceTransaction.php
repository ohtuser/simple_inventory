<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static function transactionStore($invoice,$request){
        foreach($request->product as $key=>$pro){
            if($pro){
                $details = [
                    'invoice_id' => $invoice->id,
                    'transaction_type' => $request->transaction_type,
                    'in_out' => $request->in_out,
                    'party_id' => $request->party,
                    'product_id' => $request->product[$key],
                    'description' => $request->description[$key],
                    'dc_manual' => $request->dc_manual[$key],
                    'dc_percentage' => $request->dc_percentage[$key],
                    'dc_amount' => discountAmountCalculator($request->price[$key],$request->dc_percentage[$key],$request->dc_manual[$key]),
                    'quantity' => $request->qty[$key],
                    'price' => $request->price[$key],
                    'price_after_discount' => $request->price[$key] - discountAmountCalculator($request->price[$key],$request->dc_percentage[$key],$request->dc_manual[$key]),
                    'status' => 1,
                    'created_by' => user()->id,
                ];

                if(isset($request->row_id[$key])){

                }else{
                    InvoiceTransaction::create($details);
                }
            }
        }
        return true;
    }
}
