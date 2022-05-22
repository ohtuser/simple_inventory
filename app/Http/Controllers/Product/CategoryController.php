<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Traits\ListTrait;

class CategoryController extends Controller
{
    use ListTrait;
    public function index()
    {
        return view('product.category.index');
    }

    public function list()
    {
        $data = ProductCategory::where('status', 1)->where('parent', null)->paginate(10);
        $body = $this->getCategoryList($data);
        $paginate = $data->links();
        $paginate = $paginate->render();
        return response()->json(['body' => $body, 'paginate' => $paginate]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $message = 'Category/Sub Category Added Successfully';
        if (!$request->row_id) {
            $message = 'Category/Sub Category Updated Successfully';
        }
        ProductCategory::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close', 1000, 'getCategory'), 200);
    }

    public function edit(Request $request)
    {
        $info = ProductCategory::findOrFail($request->row_id);
        return response()->json(['info' => $info]);
    }

    public function sub_category_index()
    {
        $categories = ProductCategory::where('status', 1)->where('parent', null)->get();
        return view('product.sub_category.index', compact('categories'));
    }

    public function sub_category_list()
    {
        $data = ProductCategory::where('status', 1)->with('getCategory')->where('parent', '!=', null)->paginate(10);
        // dd($data);
        $body = $this->getCategoryList($data, 1);
        $paginate = $data->links();
        $paginate = $paginate->render();
        return response()->json(['body' => $body, 'paginate' => $paginate]);
    }
}
