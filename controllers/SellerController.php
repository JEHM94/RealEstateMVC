<?php

namespace Controllers;

use MVC\Router;
use Model\Seller;

class SellerController
{
    public static function create(Router $router)
    {
        $seller = new Seller();
        $errors = Seller::getErrors();

        // Check if the Form was sent by the User
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Create a new Seller
            $seller = new Seller($_POST['seller']);

            // Validates the Form filled by the User
            $errors = $seller->validate();

            // if there are no errors then insert into the DataBase
            if (empty($errors)) {
                // Inserts a New Seller Into Database
                $seller->saveToDB();
            }
        }

        $router->renderView('sellers/crear', [
            'seller' => $seller,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        echo 'Updating seller';
    }
    public static function delete(Router $router)
    {
        echo 'Deleting seller';
    }
}
