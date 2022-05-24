<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SidebarController;
use App\Models\User;
use App\Models\UserWiseOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        return view('admin.auth.login');
    }

    public function loginAttempt(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $userInfo = User::where('email', $request->email)->whereIn('user_type', [1, 2, 3, 5])->first();
        if ($userInfo) {
            if (Hash::check($request->password, $userInfo->password)) {

                if ($userInfo->user_type == 1) {
                    Auth::guard('admin')->login($userInfo);
                    $redirectTo = '/';
                } else if ($userInfo->user_type == 2) {
                    Auth::guard('stuff')->login($userInfo);
                    $redirectTo = '/';
                } else {
                    Auth::guard('customer')->login($userInfo);
                    $redirectTo = '/';
                }
                SidebarController::set_sidebar($userInfo->user_type);
                session()->put('auth', $userInfo);
                return response()->json(requestSuccess('Login Success', '', $redirectTo, 500), 200);
            } else {
                return response()->json([
                    'message' => 'Password Not Matched',
                ], 421);
            }
        } else {
            return response()->json([
                'message' => 'Email Not Found',
            ], 421);
        }
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('stuff')->logout();
        Auth::guard('customer')->logout();
        session()->forget('sidebar');
        return redirect()->route('login');
    }

    function forgot_password()
    {
        return view('admin.auth.forgot_password');
    }

    function sent_otp(Request $request)
    {
        $is_email = User::where('email', $request->email)->first();
        if ($is_email) {
            UserWiseOtp::create(['user_id' => $is_email->id, 'otp' => 123456, 'is_used' => 0]);
            return response()->json(['status' => 1, 'info' => $is_email]);
        } else {
            return response()->json(['message' => 'Email Not Found'], 421);
        }
    }

    function verify_otp(Request $request)
    {
        $is_otp_matched = UserWiseOtp::where('user_id', $request->user_id)->where('is_used', 0)->latest()->first();
        if ($is_otp_matched) {
            if ($is_otp_matched->otp == $request->otp) {
                return response()->json(['status' => 1]);
            } else {
                return response()->json(['message' => 'OTP Not Matched'], 421);
            }
        } else {
            return response()->json(['message' => 'OTP Not Matched'], 421);
        }
    }

    function change_password(Request $request)
    {
        User::findOrFail($request->user_id)->update(['password' => Hash::make($request->password)]);
        return response()->json(requestSuccess('Password Changed', '', route('login'), 500), 200);
    }
}
