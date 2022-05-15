<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['users'] = User::get();
        $data['products'] = Products::get();
        $data['brands'] = Brand::get();
        $data['categories'] = ProductCategory::where('parent', null)->get();
        $data['units'] = Unit::get();
        return view('welcome', $data);
    }

    public function profile()
    {
        $user = User::find(user()->id);
        return view('profile.profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . user()->id
        ]);

        $data = [
            'name' => $request->name, 'email' => $request->email
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);;
        }
        User::find(user()->id)->update($data);
        return response()->json(requestSuccess('Profile Updated Successfully', '', 'reload', 500, 1000, ''), 200);
    }
}
