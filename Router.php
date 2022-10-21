<?php

namespace MVC;

class Router
{

    public $routesPOST = [];
    public $routesGET = [];

    public function get($url, $function)
    {
        $this->routesGET[$url] = $function;
    }

    public function verifyRoutes()
    {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $function = $this->routesGET[$currentUrl] ?? null;
        }

        if ($function) {
            // The URL exists and has a valid function
            call_user_func($function, $this);
        } else {
            echo "Page not found.";
        }
    }

    public function renderView($view, $data = [])
    {
        foreach($data as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $content = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
