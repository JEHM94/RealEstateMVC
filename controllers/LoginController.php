<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        // Check if the user is authenticated already
        session_start();
        $auth = $_SESSION['login'] ?? null;

        if ($auth) {
            header('Location: /admin');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data and create a new Admin Instance
            $auth = new Admin($_POST);

            $errors = $auth->validate();

            if (empty($errors)) {
                // Check if the User extist
                $result = $auth->userExists();

                if (!$result) {
                    // If the user doesnt exist get the error
                    $errors = Admin::getErrors();
                } else {
                    // Check if the Password is valid
                    $isAuth = $auth->verifyPassword($result);

                    // If the Password is valid
                    if ($isAuth) {
                        // Auth successfuly. Session Starts
                        $auth->authenticate();
                    } else {
                        // If the password doesnt match get the error
                        $errors = Admin::getErrors();
                    }
                }
            }
        }

        $router->renderView('auth/login', [
            'errors' => $errors
        ]);
    }

    public static function logout()
    {
        // Start the session
        session_start();
        // Clean the currect session
        $_SESSION = [];
        // Redirect to main page
        header('Location: /');
    }
}
