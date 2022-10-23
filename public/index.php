<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropertyController;
use Controllers\SellerController;

$router = new Router;

$router->get('/admin', [PropertyController::class, 'index']);
// Create Property Routes
$router->get('/properties/crear', [PropertyController::class, 'create']);
$router->post('/properties/crear', [PropertyController::class, 'create']);
// Update Property Routes
$router->get('/properties/actualizar', [PropertyController::class, 'update']);
$router->post('/properties/actualizar', [PropertyController::class, 'update']);
// Delete Property Routes
$router->get('/properties/eliminar', [PropertyController::class, 'delete']);
$router->post('/properties/eliminar', [PropertyController::class, 'delete']);

// Create Seller Routes
$router->get('/sellers/crear', [SellerController::class, 'create']);
$router->post('/sellers/crear', [SellerController::class, 'create']);
// Update Seller Routes
$router->get('/sellers/actualizar', [SellerController::class, 'update']);
$router->post('/sellers/actualizar', [SellerController::class, 'update']);
// Delete Seller Routes
$router->get('/sellers/eliminar', [SellerController::class, 'delete']);
$router->post('/sellers/eliminar', [SellerController::class, 'delete']);


$router->verifyRoutes();
