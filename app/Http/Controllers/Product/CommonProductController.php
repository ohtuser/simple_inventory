<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class CommonProductController extends Controller
{
    public function getSubcategory(Request $request){
        $category = $request->category;
        $sub_categories = ProductCategory::where('parent', $category)->get();
        return response()->json(['subcat' => $sub_categories]);
    }

    public function getProductDetails(Request $request){
        $info = Products::with('getCategory','getSubCategory','getBrand','getUnit')->findOrFail($request->id);
        $returnHtml = '<div class="d-flex justify-content-center mb-2">
                <image src="'.asset('images/product/'.$info->image).'" style="max-width: 100px;">
            </div>';
        $returnHtml .= '<table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>'.$info->name.'</td>
                </tr>
                <tr>
                    <td>Local Name</td>
                    <td>'.$info->local_name.'</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>'.$info->getCategory->name.'</td>
                </tr>
                <tr>
                    <td>Sub Category</td>
                    <td>'.$info->getSubCategory->name.'</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>'.$info->getBrand->name.'</td>
                </tr>
                <tr>
                    <td>Unit</td>
                    <td>'.$info->getUnit->name.'</td>
                </tr>
                <tr>
                    <td>Buy Price</td>
                    <td>'.$info->buy_price.'</td>
                </tr>
                <tr>
                    <td>Buy Price Code</td>
                    <td>'.$info->buy_price_code.'</td>
                </tr>
                <tr>
                    <td>Sell Price</td>
                    <td>'.$info->sell_price.'</td>
                </tr>
                <tr>
                    <td>Sell Price Code</td>
                    <td>'.$info->sell_price_code.'</td>
                </tr>
                <tr>
                    <td>Reorder Level</td>
                    <td>'.$info->reorder_level.'</td>
                </tr>
                <tr>
                    <td>Item Group</td>
                    <td>'.($info->item_group == 1 ? 'Consumeable' : 'Services').'</td>
                </tr>
                <tr>
                    <td>Product Code</td>
                    <td>'.$info->product_code.'</td>
                </tr>
                <tr>
                    <td>Serial</td>
                    <td>'.$info->serial.'</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>'.$info->description.'</td>
                </tr>
            </tbody></table>';
        return response()->json(['info'=>$returnHtml]);
    }
}
