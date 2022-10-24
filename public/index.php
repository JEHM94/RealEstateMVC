<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropertyController;
use Controllers\SellerController;
use Controllers\SiteController;

$router = new Router;

// Main Site Routes
$router->get('/', [SiteController::class, 'index']);
$router->get('/nosotros', [SiteController::class, 'nosotros']);
$router->get('/propiedades', [SiteController::class, 'propiedades']);
$router->get('/propiedad', [SiteController::class, 'propiedad']);
$router->get('/blog', [SiteController::class, 'blog']);
$router->get('/entrada', [SiteController::class, 'entrada']);
$router->get('/contacto', [SiteController::class, 'contacto']);
$router->post('/contacto', [SiteController::class, 'contacto']);

// Adming Route
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
