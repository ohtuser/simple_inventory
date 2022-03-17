<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Traits\ListTrait;
use App\Models\Products;
use App\Models\Unit;

class ProductController extends Controller
{
    use ListTrait;
    public function index(){
        $data['categories'] = ProductCategory::where('parent', null)->get();
        $data['brands'] = Brand::where('status', 1)->get();
        $data['units'] = Unit::where('status', 1)->get();
        return view('product.product.index', $data);
    }

    public function list(){
        $data = Products::with('getCategory','getSubCategory','getBrand','getUnit')
            ->where('status', 1)->paginate(10);
        $body = $this->getProductList($data);
        $paginate = $data->links();
        $paginate = $paginate->render();
        return response()->json(['body'=>$body, 'paginate'=>$paginate]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:50|unique:products,name,'.$request->row_id,
            'category' => 'required',
            'brand' => 'required',
            'unit' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'reorder_level' => 'required'
        ]);
        $message = 'Product Added Successfully';
        if(!$request->row_id){
            $message = 'Product Updated Successfully';
        }
        Products::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close',1000, 'getProduct'),200);
    }

    public function edit(Request $request){
        $info = Products::findOrFail($request->row_id);
        return response()->json(['info'=>$info]);
    }
}
