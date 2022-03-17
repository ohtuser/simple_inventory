<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Traits\ListTrait;

class BrandController extends Controller
{
    use ListTrait;
    public function index(){
        return view('product.brand.index');
    }

    public function list(){
        $data = Brand::where('status', 1)->paginate(10);
        $body = $this->getBrandList($data);
        // return $data->data;
        $paginate = $data->links();
        $paginate = $paginate->render();
        return response()->json(['body'=>$body, 'paginate'=>$paginate]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:50|unique:brands,name,'.$request->row_id
        ]);
        $message = 'Brand Added Successfully';
        if(!$request->row_id){
            $message = 'Brand Updated Successfully';
        }
        Brand::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close',1000, 'getBrand'),200);
    }

    public function edit(Request $request){
        $info = Brand::findOrFail($request->row_id);
        return response()->json(['info'=>$info]);
    }
}
