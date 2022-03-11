<?php
use Illuminate\Support\Facades\Auth;

function getProjectName(){
    return "Simple Inventory";
}

function get_guard(){
    $guards=array_keys(config('auth.guards'));
    // return $guards;
    $except=['web','api'];
    $filteredGuards=array_diff($guards,$except);
    foreach($filteredGuards as $guard){
         if(Auth::guard($guard)->check())
            {return $guard;}
    }
    return null;
}

function requestSuccess($message='',$description='',$redirectTo='closeAndModalHide',$timer=null,$buttonShow=false){
    return (object)[
        'buttonShow' => $buttonShow,
        'timer' => $timer,
        'message' => $message,
        'description' => $description,
        'redirectTo' => $redirectTo
    ];
}

function user(){
    return session()->get('auth');
}

function userTypes($type){
    $typeArr = [
        '1'=> 'Admin',
        '2' => 'Stuff',
        '3' => 'Customer'
    ];
    if($type){
        return $typeArr[$type];
    }
    return $typeArr;
}

function getUserType(){
    return userTypes(user()->user_type);
}
