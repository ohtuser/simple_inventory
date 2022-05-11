<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static function invoiceStore($request)
    {
        $data = [
            'transaction_type' => $request->transaction_type,
            'date' => date('Y-m-d', strtotime($request->date)),
            'party_id' => $request->party,
            'invoice_no' => generateInvoice($request->transaction_type),
            'ref_invoice' => null,
            'ref_invoice_model' => null,
            'manual_ref_invoice' => $request->ref_invoice,
            'bill_no' => $request->bill_no,
            'bill_no_date' => date('Y-m-d', strtotime($request->bill_date)),
            'grand_total' => $request->g_total,
            'discount' => $request->discount,
            'net_total' => $request->payable,
            'payable' => $request->payable,
            'pay' => $request->pay_amount,
            'due' => $request->payable - $request->pay_amount,
            'note' => $request->remarks,
            'status' => 1,
            'created_by' => user()->id
        ];

        if ($request->order_id) {
            $order = Order::findOrFail($request->order_id);
            $order->update(['status' => 2]);


            $data['ref_invoice'] = $order->id;
            $data['ref_invoice_model'] = 'App\Models\Order';
        }

        if ($request->inv_row_id) {
        } else {
            return Invoice::create($data);
        }
    }



    // ============================= Relations =============================

    public function get_party()
    {
        return $this->belongsTo(User::class, 'party_id');
    }

    public function get_transactions()
    {
        return $this->hasMany(InvoiceTransaction::class, 'invoice_id');
    }
}
