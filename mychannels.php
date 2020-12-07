<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/7/2020
 * Time: 9:21 AM
 */
if(isset($_POST)){
    spl_autoload_register(function ($classname){
        require_once "classes/".$classname .".php";
    });
    $user_id = $_POST['uid'];
    $user = User::withID($user_id);
    $subs = $user->getSubscriptions();
    echo json_encode(['subs'=>$subs,'email'=>$user->getEmail()]);
}