<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ListTrait;
use App\Models\DeliveryPerson;

class DeliveryController extends Controller
{
    use ListTrait;
    public function index()
    {
        return view('delivery.index');
    }

    public function list()
    {
        $data = DeliveryPerson::paginate(10);
        $body = $this->getDeliverymanList($data);
        // return $data->data;
        $paginate = $data->links();

        $paginate = $paginate->render();
        return response()->json(['body' => $body, 'paginate' => $paginate]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50'
        ]);
        $message = 'Admin/Stuff Added Successfully';
        if (!$request->row_id) {
            $request->validate([
                'password' => 'min:3|max:30'
            ]);
            $message = 'Admin/Stuff Updated Successfully';
        }
        DeliveryPerson::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close', 1000, 'getUser'), 200);
    }

    public function edit(Request $request)
    {
        $info = DeliveryPerson::findOrFail($request->row_id);
        return response()->json(['info' => $info]);
    }
}
