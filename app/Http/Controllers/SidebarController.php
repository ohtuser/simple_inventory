<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public static function sidebar_write()
    {
        Sidebar::truncate();
        Sidebar::insert([
            ['module_name' => 'Dashboard', 'group_name' => 'Dashboard', 'name' => 'Dashboard', 'icon' => 'fas fa-columns', 'route' => 'dashboard', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Settings', 'group_name' => 'User Management', 'name' => 'User Management', 'icon' => 'fas fa-user', 'route' => 'admin.user.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Settings', 'group_name' => 'Deliveryman Management', 'name' => 'Deliveryman Management', 'icon' => 'fas fa-user', 'route' => 'admin.deliveryman.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Settings', 'group_name' => 'Party Management', 'name' => 'Party Management', 'icon' => 'fas fa-user', 'route' => 'admin.party.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Product Management', 'group_name' => 'Unit', 'name' => 'Unit', 'icon' => 'fas fa-bars', 'route' => 'admin.unit.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Product Management', 'group_name' => 'Brand', 'name' => 'Brand', 'icon' => 'fas fa-bars', 'route' => 'admin.brand.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Product Management', 'group_name' => 'Category', 'name' => 'Category', 'icon' => 'fas fa-bars', 'route' => 'admin.category.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Product Management', 'group_name' => 'Category', 'name' => 'Sub Category', 'icon' => 'fas fa-bars', 'route' => 'admin.sub_category.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 0, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Product Management', 'group_name' => 'Product', 'name' => 'Product', 'icon' => 'fas fa-bars', 'route' => 'admin.product.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            ['module_name' => 'Transactions', 'group_name' => 'Purchase', 'name' => 'Create', 'icon' => 'fas fa-bars', 'route' => 'transaction.purchase.create', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Transactions', 'group_name' => 'Purchase', 'name' => 'List', 'icon' => 'fas fa-bars', 'route' => 'transaction.purchase.list', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            ['module_name' => 'Transactions', 'group_name' => 'Purchase Return', 'name' => 'Create', 'icon' => 'fas fa-bars', 'route' => 'transaction.purchase_return.create', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Transactions', 'group_name' => 'Purchase Return', 'name' => 'List', 'icon' => 'fas fa-bars', 'route' => 'transaction.purchase_return.list', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            ['module_name' => 'Transactions', 'group_name' => 'Sell', 'name' => 'Create', 'icon' => 'fas fa-bars', 'route' => 'transaction.sell.create', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Transactions', 'group_name' => 'Sell', 'name' => 'List', 'icon' => 'fas fa-bars', 'route' => 'transaction.sell.list', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            ['module_name' => 'Transactions', 'group_name' => 'Sell Return', 'name' => 'Create', 'icon' => 'fas fa-bars', 'route' => 'transaction.sell_return.create', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Transactions', 'group_name' => 'Sell Return', 'name' => 'List', 'icon' => 'fas fa-bars', 'route' => 'transaction.sell_return.list', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            ['module_name' => 'Transactions', 'group_name' => 'Order', 'name' => 'List', 'icon' => 'fas fa-bars', 'route' => 'admin.order.index', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],

            // acounts
            ['module_name' => 'Accounts', 'group_name' => 'Amount Transactions', 'name' => 'Amount Transactions', 'icon' => 'fas fa-bars', 'route' => 'journal.create', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            // reports
            ['module_name' => 'Reports', 'group_name' => 'Inv Report', 'name' => 'Stock Report', 'icon' => 'fas fa-bars', 'route' => 'reports.inv_reports.stock_report', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],
            ['module_name' => 'Reports', 'group_name' => 'Inv Report', 'name' => 'Amount Transactions', 'icon' => 'fas fa-bars', 'route' => 'reports.inv_reports.journals', 'sort' => 1, 'permission_admin' => 1, 'permission_stuff' => 1, 'permission_customer' => 0, 'status' => 1],


            // customer
            ['module_name' => 'Customer', 'group_name' => 'Order', 'name' => 'Create', 'icon' => 'fas fa-bars', 'route' => 'customer.order.create', 'sort' => 1, 'permission_admin' => 0, 'permission_stuff' => 0, 'permission_customer' => 1, 'status' => 1],
            ['module_name' => 'Customer', 'group_name' => 'Order', 'name' => 'Index', 'icon' => 'fas fa-bars', 'route' => 'customer.order.index', 'sort' => 1, 'permission_admin' => 0, 'permission_stuff' => 0, 'permission_customer' => 1, 'status' => 1],
        ]);

        return 'success';
    }

    public static function set_sidebar($type)
    {
        $col_name = $type == 1 ? 'permission_admin' : ($type == 2 ? 'permission_stuff' : 'permission_customer');
        $infos = Sidebar::where($col_name, '1')->get();
        $sidebar_html = '';

        // return $infos;
        foreach ($infos->groupBy('module_name') as $info) {
            $sidebar_html .= '<div class="sb-sidenav-menu-heading p-0 pt-3 m">' . $info[0]->module_name . '</div>';
            $groups = $info->groupBy('group_name');
            foreach ($groups as $group) {
                if (count($group) > 1) {
                    $sidebar_html .= '<a class="nav-link py-0 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts' . $group[0]->id . '" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-angle-down ' . $group[0]->icon . '"></i></div>
                            ' . $group[0]->group_name . '
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts' . $group[0]->id . '" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">';
                    foreach ($group as $route) {
                        $sidebar_html .= '<a class="nav-link py-0" href="' . route($route->route) . '">' . $route->name . '</a>';
                    }
                    $sidebar_html .= '</nav></div>';
                } else {
                    $sidebar_html .= '<a class="nav-link py-0" href="' . route($group[0]->route) . '">
                        <div class="sb-nav-link-icon"><i class="' . $group[0]->icon . '"></i></div>
                        ' . $group[0]->group_name . '
                    </a>';
                }
            }
        }

        session()->put('sidebar', $sidebar_html);
        return true;
    }
}

// if(count($groups) == 1){

// }else{

// }
