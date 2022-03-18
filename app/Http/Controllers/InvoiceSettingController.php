<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use Illuminate\Http\Request;

class InvoiceSettingController extends Controller
{
    public function index(Request $request){
        $id = 1;
        if($request->id){
            $id = $request->id;
        }
        $data['invoice_type'] = InvoiceSetting::get();
        $data['item'] = $data['invoice_type']->where('id', $id)->first();
        return view('invoice_setting.index', $data);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $posting_field_show = [];
        if($request->posting_field_show){
            $posting_field_show = $request->posting_field_show;
        }
        $invoice_print_field_show = [];
        if($request->invoice_print_field_show){
            $invoice_print_field_show = $request->invoice_print_field_show;
        }

        InvoiceSetting::find($request->id)->update([
            'invoice_header'=> $request->print_head,
            'invoice_footer'=> $request->print_foot,
            'custom_css'=> $request->style_css,

            'posting_field_show'=> implode(',', $posting_field_show),
            'posting_field_label'=> implode(',', $request->posting_field_label),

            'invoice_print_field_show'=> implode(',', $invoice_print_field_show),
            'invoice_print_field_show_label'=> implode(',', $request->invoice_print_field_label),
            'fraction_digit'=> $request->fraction_digit,
            'invoice_prefix'=> $request->invoice_prefix,
        ]);

        return back();
    }
}
