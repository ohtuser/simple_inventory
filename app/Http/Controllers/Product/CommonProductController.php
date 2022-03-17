<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CommonProductController extends Controller
{
    public function getSubcategory(Request $request){
        $category = $request->category;
        $sub_categories = ProductCategory::where('parent', $category)->get();
        return response()->json(['subcat' => $sub_categories]);
    }
}
