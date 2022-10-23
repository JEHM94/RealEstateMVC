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
        // Check for valid ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        //If the id is not int redirect back to admin
        if (!$id) {
            redirectToAdmin();
        }

        //Find the property by its id
        $seller = Seller::findOnDB($id);

        // If no Seller was found then go back
        if (!$seller) {
            header('Location: /admin');
        }

        $errors = Seller::getErrors();

        // Check if the Form was sent by the User
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get user input
            $array = $_POST['seller'];

            // Sync Attributes
            $seller->syncChanges($array);

            /******* Form Validations *******/
            $errors = $seller->validate();

            // if there are no errors then Update
            if (empty($errors)) {
                // Update Seller then redirects to Admin
                $seller->saveToDB();
            }
        }

        $router->renderView('sellers/actualizar', [
            'seller' => $seller,
            'errors' => $errors
        ]);
    }
    public static function delete(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get the ID and Check if its valid
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // Find the seller by its id
                $seller = Seller::findOnDB($id);
                // if the seller exists then delete it
                if (!is_null($seller)) {
                    $seller->deleteRow();
                }
            }
        }
    }
}
