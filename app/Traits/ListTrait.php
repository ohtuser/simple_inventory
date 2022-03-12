<?php

namespace App\Traits;

trait ListTrait {

    function getPaginate($data){
        dd($data);
        $paginateHtml = '<nav aria-label="Page navigation example"><ul class="pagination">';
        foreach($data->links as $key=>$val){
            $paginateHtml .= '<li class="'.($val->url == null ? 'disabled':'') ($val->active == true ? 'active':'').'page-item"><a class="page-link" href="'.$val->url.'">'.$val->label.'</a></li>';
        };
        $paginateHtml .= '</ul></nav>';
        return $paginateHtml;
    }

    function getUserList($data = []){
        $returnHtml = '<table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
            </thead><body>';
        foreach($data as $key=>$d){
            $returnHtml .= '<tr>
                <td>'.(++$key).'</td>
                <td>'.$d->name.'</td>
                <td>'.$d->email.'</td>
            </tr>';
        }
        return $returnHtml;
    }
}
