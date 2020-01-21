<?php

namespace App;

class JSONToReturn
{
    public $result;


    public function __construct($JSON)
    {
        $this->result=$JSON;
    }
}