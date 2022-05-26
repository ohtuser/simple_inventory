<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
}
