<?php

use App\Models\Invoice;
use App\Models\InvoiceSetting;
use App\Models\Journal;
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
        3 => 'Cancelled',
        4 => 'Cancel Request',
    ];
    if ($status) {
        if ($with_badge) {
            if ($status == 1) {
                return '<span class="badge bg-primary text-light">Ordered</span>';
            } else if ($status == 2) {
                return '<span class="badge bg-success text-light">Delivered</span>';
            } else if ($status == 3) {
                return '<span class="badge bg-danger text-light">Cancelled</span>';
            } else {
                return '<span class="badge bg-warning text-dark">Cancel Request</span>';
            }
        } else
            return $arr[$status];
    } else {
        return $arr;
    }
}

function getRefInvoice($model, $id, $feild_name)
{
    $info = $model::find($id);
    if ($info) {
        return $info->$feild_name;
    } else {
        return '';
    }
}

function getSellInvoiceOfOrder($id)
{
    return Invoice::where('ref_invoice', $id)->first();
}

function getPaymentMode($status = null, $with_badge = null)
{
    $arr = [
        1 => 'Bkash',
        2 => 'Rocket',
        3 => 'Nagad'
    ];
    if ($status) {
        if ($with_badge) {
            if ($status == 1) {
                return '<span class="badge text-light" style="background-color: #E71868">Bkash</span>';
            } else if ($status == 2) {
                return '<span class="badge text-light" style="background-color: #8C2587">Rocket</span>';
            } else if ($status == 3) {
                return '<span class="badge text-light" style="background-color: #F02425">Nagad</span>';
            }
        } else
            return $arr[$status];
    } else {
        return $arr;
    }
}

function journalPosting($invoice, $party, $dr_cr, $amount, $date)
{
    if ($amount > 0) {
        Journal::create([
            'party_id' => $party,
            'dr_cr' => $dr_cr,
            'invoice_id' => $invoice,
            'amount' => $amount,
            'date' => date('Y-m-d', strtotime($date))
        ]);
    }
    return true;
}
