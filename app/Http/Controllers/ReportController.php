<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stockReport(Request $request)
    {
        $data['categories'] = ProductCategory::with('getSubCategory')->where('parent', null)->get();
        $list = Products::with('getStock', 'getUnit');
        if ($request->product) {
            $list->where('id', $request->product);
        }
        if ($request->category) {
            $list->where('category', $request->category)->orWhere('sub_category', $request->category);
        }
        // return $where;
        $data['list'] = $list->get();
        // return $data['list'];
        return view('reports.inv_reports.stock_report', $data);
    }
}
