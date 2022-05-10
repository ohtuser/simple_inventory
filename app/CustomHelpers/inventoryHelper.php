<?php

use App\Models\Invoice;
use App\Models\InvoiceSetting;
use App\Models\Order;

function getInvoiceSettings($id)
{
    return InvoiceSetting::find($id);
}

function generateInvoice($type)
{
    $invoice_setting = getInvoiceSettings($type);
    $pre_inv = Invoice::where('transaction_type', $type)->where('invoice_no', '!=', null)->orderBy('id', 'desc')->first();
    if ($pre_inv) {
        if ($invoice_setting) {
            $trimmed = str_replace($invoice_setting->invoice_prefix, '', $pre_inv->invoice_no);
            return $invoice_setting->invoice_prefix . intval($trimmed) + 1;
        } else {
            return ($pre_inv->invoice_no + 1);
        }
    } else {
        if ($invoice_setting) {
            return $invoice_setting->invoice_prefix . '1';
        } else {
            return 1;
        }
    }
}

function discountAmountCalculator($price, $dis_per, $dis_manual = 0)
{
    $amount = ($dis_per / 100) * $price;
    if (is_numeric($dis_manual)) {
        $amount += $dis_manual;
    }
    return $amount;
}

function getOrderNumber()
{
    $order = Order::latest()->first();
    if ($order) {
        $trimmed = str_replace('ORD-', '', $order->order_number);
        return 'ORD-' . intval($trimmed) + 1;
    } else {
        return 'ORD-1';
    }
}

function getOrderStatus($status = null, $with_badge = null)
{
    $arr = [
        1 => 'Ordered',
        2 => 'Delivered',
        3 => 'Cancelled'
    ];
    if ($status) {
        if ($with_badge) {
            if ($status == 1) {
                return '<span class="badge bg-primary">Ordered</span>';
            } else if ($status == 2) {
                return '<span class="badge bg-success">Delivered</span>';
            } else {
                return '<span class="badge bg-danger">Cancelled</span>';
            }
        } else
            return $arr[$status];
    } else {
        return $arr;
    }
}
