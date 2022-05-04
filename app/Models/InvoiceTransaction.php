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
                    'description' => $request->description[$key] ?? null,
                    'dc_manual' => $request->dc_manual[$key] ?? 0,
                    'dc_percentage' => $request->dc_percentage[$key] ?? 0,
                    'dc_amount' => discountAmountCalculator($request->price[$key],$request->dc_percentage[$key] ?? 0,$request->dc_manual[$key] ?? 0),
                    'quantity' => $request->qty[$key] ?? 0,
                    'price' => $request->price[$key] ?? 0,
                    'price_after_discount' => $request->price[$key] - discountAmountCalculator($request->price[$key],$request->dc_percentage[$key] ?? 0,$request->dc_manual[$key] ?? 0),
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

    // ============================= Relations =============================

    public function product(){
        return $this->belongsTo(Products::class, 'product_id');
    }
}
