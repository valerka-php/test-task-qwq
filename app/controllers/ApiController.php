<?php

namespace App\Controller;

use App\Model\Product;

class ApiController
{
    public function categoryAction()
    {
        $db = new Product();
        $categories = $db->getCategories();
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($categories);
    }
}