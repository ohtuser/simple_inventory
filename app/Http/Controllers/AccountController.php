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
        if ($info->transaction_type == 1 || $info->transaction_type == 4) {
            $html .= '<span class="badge bg-danger">Debit</span>';
        } else {
            $html .= '<span class="badge bg-success">Cradit</span>';
        }
        return response()->json(['html' => $html, 'due' => $info->due]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required',
            'amount' => 'required|numeric|min:0'
        ]);
        $info = Invoice::findOrFail($request->invoice_id);
        $dr_cr = 0;
        if ($info->transaction_type == 1 || $info->transaction_type == 4) {
            $dr_cr = 2;
        } else {
            $dr_cr = 1;
        }
        if ($info->due < $request->amount) {
            return response()->json(['message' => 'Trying to receive more than due'], 421);
        }

        $pay = $info->pay + $request->amount;
        $due = $info->payable - $pay;
        $info->update([
            'pay' => $pay,
            'due' => $due
        ]);
        journalPosting($request->invoice_id, $info->party_id, $dr_cr, $request->amount, date('Y-m-d'));
        return response()->json(requestSuccess('Amount Posted Successfully', '', 'reload', 500, '', false));
    }
}
