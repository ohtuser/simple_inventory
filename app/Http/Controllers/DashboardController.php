<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CustomerProfileUpdateRequest;
use App\Models\InvoiceTransaction;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['users'] = User::get();
        $data['products'] = Products::withSum('getSellInfo', 'quantity')->get();
        $data['brands'] = Brand::get();
        $data['categories'] = ProductCategory::where('parent', null)->get();
        $data['units'] = Unit::get();
        $data['product_names'] = $data['products']->pluck('name')->toArray();
        $data['sold_qty'] = $data['products']->pluck('get_sell_info_sum_quantity')->toArray();
        return view('welcome', $data);
    }

    public function profile()
    {
        $user = User::with('getProfileUpdateRequest')->find(user()->id);
        return view('profile.profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . user()->id,
            'image' => 'image'
        ], [
            'image.image' => 'Wrong File Type'
        ]);

        $data = [
            'name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile, 'address' => $request->address
        ];
        $msg = '';

        $password = null;
        if ($request->password) {
            $password = $data['password'] = Hash::make($request->password);
            $msg = 'Password Has Been Updated.';
        }
        $img = null;
        if ($request->hasFile('image')) {
            $img_name = time() . rand(1, 100) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/'), $img_name);
            $img = $data['image'] = $img_name;
        }
        if (user()->user_type == 1 || user()->user_type == 2) {
            User::find(user()->id)->update($data);
            $msg = 'Profile Updated Successfully';
        } else {
            CustomerProfileUpdateRequest::where('user_id', user()->id)->delete();
            $is_exist = User::where('email', $request->email)->where('id', '!=', user()->id)->first();
            if ($is_exist) {
                return response()->json(['message' => 'Email Already Exist'], 421);
            }
            CustomerProfileUpdateRequest::create([
                'user_id' => user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'image' => $img
            ]);
            if ($password != null) {
                User::find(user()->id)->update(['password' => $password]);
            }
            $msg .= 'Requested For Profile Updated';
        }

        $userInfo = User::find(user()->id);
        session()->put('auth', $userInfo);
        return response()->json(requestSuccess($msg, '', 'reload', 500, 1000, ''), 200);
    }

    public function delete(Request $request)
    {
        if ($request->model == 'users' || $request->model == 'delivery_people') {
            // $request->model::findOrFail($request->id)->delete();
            DB::table($request->model)->where('id', $request->id)->delete();
        } else if ($request->model == 'invoices') {
            DB::table($request->model)->where('id', $request->id)->delete();
            InvoiceTransaction::where('invoice_id', $request->id)->delete();
        } else {
            DB::table($request->model)->where('id', $request->id)->update(['status' => 2]);
        }
        // $request->model::findOrFail($request->id)->update([
        //     'status' =>
        // ]);
        return back();
    }


    public function profile_update_request_cancel()
    {
        CustomerProfileUpdateRequest::where('user_id', user()->id)->delete();
        return back();
    }
}
