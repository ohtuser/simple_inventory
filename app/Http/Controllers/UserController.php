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
            'email' => 'required|email|min:4|unique:users,email'.$request->row_id,
            'password' => 'required|min:3|max:30'
        ]);
        User::storeOrUpdate($request);
        return response()->json(requestSuccess('Admin/Stuff Added Successfully', '', 'close',1000, 'getUser'),200);
    }
}
