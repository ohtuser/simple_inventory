<?php

use App\Models\Invoice;
use App\Models\InvoiceSetting;

function getInvoiceSettings($id){
    return InvoiceSetting::find($id);
}

function generateInvoice($type){
    $invoice_setting = getInvoiceSettings($type);
    $pre_inv = Invoice::where('transaction_type', $type)->orderBy('id','desc')->first();
    if($pre_inv){
        if($invoice_setting){

        }else{
            return ($pre_inv->invoice_no+1);
        }
    }else{
        if($invoice_setting){
            return $invoice_setting->invoice_prefix.'1';
        }else{
            return 1;
        }
    }
}

function discountAmountCalculator($price,$dis_per,$dis_manual = 0){
    $amount = ($dis_per / 100) * $price;
    if(is_numeric($dis_manual)){
        $amount += $dis_manual;
    }
    return $amount;
}
