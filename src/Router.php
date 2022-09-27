<?php

namespace Src;

class Router
{
    private array $route = ['controller' => 'home', 'action' => 'index'];

    private function add(string $request): void
    {
        $pattern = "(\?[a-zA-Z]+)";

        $path = explode('/', htmlspecialchars(mb_substr($request, 1)));

        foreach ($path as $key => $value) {
            if (!empty($value) && !preg_match($pattern, $value) && $key == 0) {
                $this->route['controller'] = $value;
            } elseif (!empty($value) && !preg_match($pattern, $value) && $key == 1) {
                $this->route['action'] = $value;
            }
        }
    }

    private function match(string $request): void
    {
        $this->add($request);
        $controller = $this->route['controller'];
        $view = $this->route['action'];
        $class = 'App\Controller\\' . ucfirst($controller) . 'Controller';
        if (class_exists($class)) {
            $action = $view . 'Action';
            if (method_exists($class, $action)) {
                $cObj = new $class($this->route['controller']);
                $cObj->$action();
            } else {
                echo 'method doesn`t exist';
            }
        } else {
            echo 'class not found';
        }
    }

    public static function run(string $request): void
    {
        $obj = new self();
        $obj->match($request);
    }
}