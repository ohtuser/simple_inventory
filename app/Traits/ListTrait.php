<?php

namespace App\Traits;

trait ListTrait {

    // function getPaginate($data){
    //     // dd($data);
    //     $paginateHtml = '<nav aria-label="Page navigation example"><ul class="pagination">';
    //     foreach($data->links as $key=>$val){
    //         $paginateHtml .= '<li class="'.($val->url == null ? 'disabled':'') ($val->active == true ? 'active':'').'page-item"><a class="page-link" href="'.$val->url.'">'.$val->label.'</a></li>';
    //     };
    //     $paginateHtml .= '</ul></nav>';
    //     return $paginateHtml;
    // }

    function getUserList($data = []){
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'</td>
                <td>'.$d->email.'</td>
                <td>'.userTypes($d->user_type).'</td>
                <td><a href="" data-row-id="'.$d->id.'" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getUnitList($data = []){
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'</td>
                <td><a href="" data-row-id="'.$d->id.'" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getBrandList($data = []){
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead><body>';
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'</td>
                <td><a href="" data-row-id="'.$d->id.'" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getCategoryList($data = [],$sub_category = null){
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>';
                    if($sub_category){
                        $returnHtml .= '<th>Category</th>';
                    }
                    $returnHtml .= '<th>Action</th>
                </tr>
            </thead><body>';
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'</td>';
                if($sub_category){
                    $returnHtml .= '<td>'.($d->getCategory->name ?? '-').'</td>';
                }
                $returnHtml .= '<td><a href="" data-row-id="'.$d->id.'" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }

    function getProductList($data = []){
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
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'<br> - '.$d->local_name.'</td>
                <td>'.$d->getCategory->name.'<br> - '.$d->getSubCategory->name.'</td>
                <td>'.$d->getUnit->name.'<br> - '.$d->getBrand->name.'</td>
                <td>'.$d->buy_price.'<br> - '.$d->buy_price_code.'</td>
                <td>'.$d->sell_price.'<br> - '.$d->sell_price_code.'</td>
                <td><a href="" data-row-id="'.$d->id.'" class="btn btn-warning btn-sm btn_edit">Edit</a></td>
            </tr>';
        }
        return $returnHtml;
    }
}
