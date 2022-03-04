<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function loginAttempt(Request $request){

        // $dashboard = route('dashboard');
        $dashboard = 'close';
        return response()->json([
            'redirectTo' => $dashboard
        ]);
    }
}
