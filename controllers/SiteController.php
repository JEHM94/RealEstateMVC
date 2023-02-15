<?php

namespace Controllers;

use MVC\Router;
use Model\Property;
use PHPMailer\PHPMailer\PHPMailer;

class SiteController
{
    public static function index(Router $router)
    {
        $properties = Property::getLimit(3);
        $isIndex = true;

        $router->renderView('paginas/index', [
            'properties' => $properties,
            'isIndex' => $isIndex
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->renderView('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $properties = Property::getAll();

        $router->renderView('paginas/propiedades', [
            'properties' => $properties
        ]);
    }

    public static function propiedad(Router $router)
    {
        // Check for valid ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        //If the id is not int redirect back to admin
        if (!$id) {
            header('Location: /propiedades');
        }

        // Find the property by its ID
        $property = Property::findOnDB($id);

        // If no property was found then go back
        if (!$property) {
            header('Location: /propiedades');
        }

        $router->renderView('paginas/propiedad', [
            'property' => $property
        ]);
    }

    public static function blog(Router $router)
    {
        $router->renderView('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->renderView('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        $resultMessage = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactForm = $_POST['contact'];

            // Create a new PHPMailer instance
            $mail = new PHPMailer();
            // Config SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['PHP_MAILER_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['PHP_MAILER_USERNAME'];
            $mail->Password = $_ENV['PHP_MAILER_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['PHP_MAILER_PORT'];

            // Config email Content
            $mail->setFrom('admin@realestate.com' , 'RealEstate.com');
            $mail->addAddress('jesus.e.hamel@gmail.com', 'RealEstate.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Enable HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Email content
            $content =  '<html>';
            $content .= '<p>Tienes un Nuevo Mensaje</p>';
            $content .= '<p>Nombre: ' . $contactForm['name'] . '</p>';
            $content .= '<p>Mensaje: ' . $contactForm['message'] . '</p>';
            $content .= '<p>Vender/Comprar: ' . $contactForm['type'] . '</p>';
            $content .= '<p>Precio/Presupuesto: $' . $contactForm['price'] . '</p>';
            $content .= '<p>Desea ser contactado por:</p>';
            // Check the contact type
            if ($contactForm['contact'] === 'Telefono') {
                // User choosed to be contacted by Phone
                $content .= '<p>Teléfono: ' . $contactForm['phone'] . '</p>';
                $content .= '<p>El día: ' . $contactForm['date'] . '</p>';
                $content .= '<p>A las: ' . $contactForm['time'] . ' hrs.</p>';
            } else {
                // User choosed to be contacted by Email
                $content .= '<p>Email: ' . $contactForm['email'] . '</p>';
            }
            $content .= '</html>';

            $mail->Body = $content;
            $mail->AltBody = 'Texto alternativo sin HTML';

            // Send the Email
            if ($mail->send()) {
                $resultMessage = 'Mensaje Enviado Correctamente';
            } else {
                $resultMessage = 'No se pudo enviar el Mensaje';
            }
        }

        $router->renderView('paginas/contacto', [
            'resultMessage' => $resultMessage,
        ]);
    }
}
