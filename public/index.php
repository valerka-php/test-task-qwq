<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '../../vendor/autoload.php';

use Src\Router;

Router::run($_SERVER['REQUEST_URI']);


