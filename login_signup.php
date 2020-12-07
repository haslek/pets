<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/7/2020
 * Time: 9:46 AM
 */
if(isset($_POST)){
    spl_autoload_register(function ($classname){
        require_once "classes/".$classname .".php";
    });
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $new_user  = false;
    $c_pass = null;
    if(isset($_POST['new_user'])){
        $new_user = true;
    }
    $user = User::withEmail($user_email,$user_password,$new_user);
    echo json_encode(['id'=>$user->getID(),'error'=>$user->getError()]);
}