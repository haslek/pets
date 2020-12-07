<?php

/**
 * Created by HASSAN.
 * User: HASSAN
 * Date: 9/28/2019
 * Time: 3:49 AM
 * Project: leatrix
 */
class Database
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost','root','','pets') or die('Error connecting to database');
    }

    /**
     * @return mysqli
     */
    public function getConn(): mysqli
    {
        return $this->conn;
    }

    public function get($table_name,$params = null)
    {
        if ($params != null){
            $num_of_params = count($params);
        }
    }
    
    public function insert($table_name, $params = array())
    {
        if(count($params) < 1){
            return "Parameters must have at least one key value pair";
        }else{

//            $this->conn->
        }

    }
}