<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->party) {
            array_push($where, ['party_id', $request->party]);
        }
        $data['list'] = Journal::where('date', '<=', date('Y-m-d', strtotime($request->sdate)))
            ->where('date', '>=', date('Y-m-d', strtotime($request->edate)))->where($where)->get();
        $data['parties'] = User::whereNotIn('user_type', [1, 2])->get();
        return view('accounts.journal.list', $data);
    }

    public function create()
    {
        $data['invoices'] = Invoice::select('id', 'invoice_no')->where('due', '>', 0)->get();
        return view('accounts.journal.create', $data);
    }

    public function invoice_info(Request $request)
    {
        $info = Invoice::with('get_party')->findOrFail($request->id);
        $html = '<p class="mb-0"><b>Invoice No: </b>' . $info->invoice_no . '</p>';
        $html .= '<p class="mb-0"><b>Party: </b>' . $info->get_party->name . '</p>';
        $html .= '<p class="mb-0"><b>Total Amount: </b>' . $info->payable . '</p>';
        $html .= '<p class="mb-0"><b>Total Paid: </b>' . $info->pay . '</p>';
        $html .= '<p class="mb-0"><b>Total Due: </b>' . $info->due . '</p>';
        return response()->json(['html' => $html, 'due' => $info->due]);
    }
}
