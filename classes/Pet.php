<?php

/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/6/2020
 * Time: 1:09 PM
 */
class Pet
{
    private $name;
    private $id;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
    public function save(){

    }
    public function getUpdates(){

    }
}