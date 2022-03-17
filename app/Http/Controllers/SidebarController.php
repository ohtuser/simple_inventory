<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function sidebar_write(){
        Sidebar::truncate();
        Sidebar::insert([
            ['module_name'=>'Settings', 'group_name'=>'User Management', 'name'=>'User Management', 'sort'=>1, 'permission_admin'=>1,'permission_stuff'=>0,'permission_customer'=>0,'status'=>1],
            ['module_name'=>'Settings', 'group_name'=>'Party Management', 'name'=>'Party Management', 'sort'=>1, 'permission_admin'=>1,'permission_stuff'=>1,'permission_customer'=>0,'status'=>1],
        ]);

        return 'success';
    }
}
