<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stockReport(Request $request){
        $data['categories'] = ProductCategory::with('getSubCategory')->where('parent', null)->get();
        return view('reports.inv_reports.stock_report', $data);
    }
}
