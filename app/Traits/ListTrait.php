<?php

namespace App\Traits;

trait ListTrait
{
    function getUserList($data = [])
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '</td>
                <td>' . $d->email . '</td>
                <td>' . userTypes($d->user_type) . '</td>
                <td>' . $d->mobile . '</td>
                <td>' . $d->address . '</td>
                <td><a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getDeliverymanList($data = [])
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Shift</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '</td>
                <td>' . ($d->shift == 1 ? '1st' : ($d->shift == 2 ? '2nd' : '3rd')) . ' Shift</td>
                <td>' . $d->mobile . '</td>
                <td>' . $d->address . '</td>
                <td><a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getUnitList($data = [])
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '</td>
                <td><a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getBrandList($data = [])
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '</td>
                <td><a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getCategoryList($data = [], $sub_category = null)
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>';
        if ($sub_category) {
            $returnHtml .= '<th>Category</th>';
        }
        $returnHtml .= '<th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '</td>';
            if ($sub_category) {
                $returnHtml .= '<td>' . ($d->getCategory->name ?? '-') . '</td>';
            }
            $returnHtml .= '<td><a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getProductList($data = [])
    {
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Unit/Brand</th>
                    <th>Buy Price/Code</th>
                    <th>Sell Price/Code</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach ($data as $key => $d) {
            $returnHtml .= '<tr>
                <td>' . (++$key) . '</td>
                <td>' . $d->name . '<br> - ' . $d->local_name . '</td>
                <td>' . $d->getCategory->name . '<br> - ' . ($d->getSubCategory->name ?? '') . '</td>
                <td>' . $d->getUnit->name . '<br> - ' . $d->getBrand->name . '</td>
                <td>' . $d->buy_price . '<br> - ' . $d->buy_price_code . '</td>
                <td>' . $d->sell_price . '<br> - ' . $d->sell_price_code . '</td>
                <td>
                    <a href="" data-row-id="' . $d->id . '" class="btn btn-warning btn-sm btn_edit"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-info btn-sm text-white" onclick="showProductDetails(' . $d->id . ')"><i class="fas fa-info"></i></button>
                </td>
            </tr>';
        }
        return $returnHtml;
    }
}
