<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Traits\ListTrait;

class UnitController extends Controller
{
    use ListTrait;
    public function index(){
        return view('product.unit.index');
    }

    public function list(){
        $data = Unit::where('status', 1)->paginate(10);
        $body = $this->getUnitList($data);
        // return $data->data;
        $paginate = $data->links();
        $paginate = $paginate->render();
        return response()->json(['body'=>$body, 'paginate'=>$paginate]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:50|unique:units,name,'.$request->row_id
        ]);
        $message = 'Unit Added Successfully';
        if(!$request->row_id){
            $message = 'Unit Updated Successfully';
        }
        Unit::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close',1000, 'getUnit'),200);
    }

    public function edit(Request $request){
        $info = Unit::findOrFail($request->row_id);
        return response()->json(['info'=>$info]);
    }
}
