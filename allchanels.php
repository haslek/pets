<?php
/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/7/2020
 * Time: 2:19 PM
 */
spl_autoload_register(function ($classname){
    require_once "classes/".$classname .".php";
});
$db = new Database();
$dbcon = $db->getConn();
$channels = $dbcon->query('Select * from pets')
    ->fetch_all(MYSQLI_ASSOC);
//var_dump($channels);
echo json_encode(['pets'=>$channels]);
exit();