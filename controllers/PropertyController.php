<?php

namespace Controllers;

use MVC\Router;

class PropertyController
{

    public static function index(Router $router)
    {
        $router->renderView('properties/admin', [
            'mensaje' => 'Desde la vista'
        ]);
    }

    public static function create()
    {
        echo 'create';
    }

    public static function update()
    {
        echo 'update';
    }
}
