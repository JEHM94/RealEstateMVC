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

    public function post($url, $function)
    {
        $this->routesPOST[$url] = $function;
    }

    public function verifyRoutes()
    {
        // Auth
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Protected Routes Array
        $protected_routes = [
            '/admin',
            '/properties/crear',
            '/properties/actualizar',
            '/properties/eliminar',
            '/sellers/crear',
            '/sellers/actualizar',
            '/sellers/eliminar'
        ];

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $function = $this->routesGET[$currentUrl] ?? null;
        }

        if ($method === 'POST') {
            $function = $this->routesPOST[$currentUrl] ?? null;
        }

        // Protect Routes
        // If the current Url is a protected route
        // and the user is not authenticated then redirect to /
        if (in_array($currentUrl, $protected_routes) && !$auth) {
            header('Location: /');
        }

        if ($function) {
            // The URL exists and has a valid function
            call_user_func($function, $this);
        } else {
            //echo "Page not found.";
            $this->renderView('/paginas/unknown');
        }
    }

    public function renderView($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $content = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
