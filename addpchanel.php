<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/7/2020
 * Time: 1:05 PM
 */
if(isset($_POST)){
    spl_autoload_register(function ($classname){
        require_once "classes/".$classname .".php";
    });
    $uid = $_POST['uid'];
    $pchan = $_POST['pchanel'];
    $user = User::withID($uid);
    $user->setPreferredChanel($pchan);
    if($user->getError() == null){
        echo json_encode(['message'=>'Preferred channel set!!']);
        exit();
    }
    echo json_encode(['error'=>$user->getError()]);
    exit();
}