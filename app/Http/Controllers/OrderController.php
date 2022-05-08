<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $data['categories'] = ProductCategory::whereHas('getSubCategory.getProductsSubCatWise')->with(
            'getSubCategory.getProductsSubCatWise.getBrand',
            'getSubCategory.getProductsSubCatWise.getUnit',
            'getSubCategory.getProductsSubCatWise.getStock'
        )->where('parent', null)->get();

        // return $data;
        return view('order.create', $data);
    }
}
