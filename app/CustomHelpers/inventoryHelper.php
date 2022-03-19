<?php

use App\Models\InvoiceSetting;

function getInvoiceSettings($id){
    return InvoiceSetting::find($id);
}
