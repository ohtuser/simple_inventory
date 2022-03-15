<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        return view('admin.auth.login');
    }

    public function loginAttempt(Request $request){
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $userInfo = User::where('email', $request->email)->first();
        if($userInfo){
            if(Hash::check($request->password, $userInfo->password)){

                if($userInfo->user_type == 1){
                    Auth::guard('admin')->login($userInfo);
                    $redirectTo = '/';
                }else if($userInfo->user_type == 2){
                    Auth::guard('stuff')->login($userInfo);
                    $redirectTo = '/';
                }else{
                    Auth::guard('customer')->login($userInfo);
                    $redirectTo = '/';
                }

                session()->put('auth', $userInfo);
                return response()->json(requestSuccess('Login Success', '', $redirectTo,500),200);
            }else{
                return response()->json([
                    'message' => 'Password Not Matched',
                ],421);
            }
        }else{
            return response()->json([
                'message' => 'Email Not Found',
            ],421);
        }
    }

    function logout(){
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        return redirect()->route('login');
    }
}
