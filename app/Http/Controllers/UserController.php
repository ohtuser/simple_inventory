<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ListTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ListTrait;
    public function index(){
        return view('user.index');
    }

    public function list(){
        $data = User::whereIn('user_type', [1,2])->paginate(10);
        $body = $this->getUserList($data);
        // return $data->data;
        $paginate = $data->links();

        $paginate = $paginate->render();
        // $paginate = $this->getPaginate($data->links->get());
        // $paginate = '';
        return response()->json(['body'=>$body, 'paginate'=>$paginate]);
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required',
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|min:4|unique:users,email,'.$request->row_id
        ]);
        $message = 'Admin/Stuff Added Successfully';
        if(!$request->row_id){
            $request->validate([
                'password' => 'min:3|max:30'
            ]);
            $message = 'Admin/Stuff Updated Successfully';
        }
        User::storeOrUpdate($request);
        return response()->json(requestSuccess($message, '', 'close',1000, 'getUser'),200);
    }

    public function edit(Request $request){
        $info = User::findOrFail($request->row_id);
        return response()->json(['info'=>$info]);
    }
}
