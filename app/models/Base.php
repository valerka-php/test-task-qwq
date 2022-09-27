<?php

namespace App\Model;

use Src\DB;

class Base
{
    public object $connect;

    public function __construct()
    {
        $db = new DB();
        $this->connect = $db->getInstance();
    }
}