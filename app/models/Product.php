<?php

namespace App\Model;

class Product extends Base
{
    public function getCategories()
    {
        $request = "SELECT * FROM categories";
        return $this->connect->get($request);
    }
}