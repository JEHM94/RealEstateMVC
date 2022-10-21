<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropertyController;

$router = new Router;

$router->get('/admin', [PropertyController::class, 'index']);
$router->get('/properties/crear', [PropertyController::class, 'create']);
$router->get('/properties/actualizar', [PropertyController::class, 'update']);

$router->verifyRoutes();
