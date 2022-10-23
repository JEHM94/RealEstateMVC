<?php

namespace Controllers;

use MVC\Router;
use Model\Property;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController
{

    public static function index(Router $router)
    {
        $properties = Property::getAll();
        $sellers = Seller::getAll();

        // Property message validation
        $message = $_GET['result'] ?? null;

        $router->renderView('properties/admin', [
            'properties' => $properties,
            'sellers' => $sellers,
            'message' => $message
        ]);
    }

    public static function create(Router $router)
    {
        $property = new Property();
        $sellers = Seller::getAll();
        $errors = Property::getErrors();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Creates a New Property Instance using the form Data
            $property = new Property($_POST['property']);

            // Files Upload
            // If the Image exists
            if ($_FILES['property']['tmp_name']['image']) {
                // Create custom unique name for the Image
                $imageName = md5(uniqid(rand(), true)) . ".jpg";

                // Save the Image Name to the Property Instace
                $property->setImage($imageName);

                // Resize Image Using Intervention 800x600 px
                // Get the Image from input name='image'
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
            }


            // Validates the Form filled by the User
            $errors = $property->validate();

            // if there are no errors then insert into the DataBase
            if (empty($errors)) {

                /* Files upload to the server */
                // Create the image folder if not exists
                if (!is_dir(IMAGE_FOLDER)) {
                    mkdir(IMAGE_FOLDER);
                }

                // Save the Image to the Server
                $image->save(IMAGE_FOLDER . $imageName);

                // Inserts a New Property Into Database
                $property->saveToDB();
            }
        }


        $router->renderView('properties/crear', [
            'property' => $property,
            'sellers' => $sellers,
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
        $property = Property::findOnDB($id);

        // If no property was found then go back
        if (!$property) {
            redirectToAdmin();
        }

        $errors = Property::getErrors();
        $sellers = Seller::getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get user input
            $array = $_POST['property'];

            // Sync Attributes
            $property->syncChanges($array);

            /******* Form Validations *******/
            $errors = $property->validate();

            // if there are no errors then Update
            if (empty($errors)) {

                /* Files upload to the server */
                // If a new Image exists
                if ($_FILES['property']['tmp_name']['image']) {
                    // Create custom unique name for the Image
                    $imageName = md5(uniqid(rand(), true)) . ".jpg";

                    // Save the Image Name to the Property Instace
                    $property->setImage($imageName);

                    // Resize Image Using Intervention 800x600 px
                    // Get the Image from input name='image'
                    $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);

                    // Save the Image to the server
                    $image->save(IMAGE_FOLDER . $imageName);
                }

                // Update Property then redirects to Admin
                $property->saveToDB();
            }
        }

        $router->renderView('properties/actualizar', [
            'property' => $property,
            'sellers' => $sellers,
            'errors' => $errors
        ]);
    }

    public static function delete()
    {
        // Delete Property
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get the ID and Check if its valid
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //Find the property by its id
                $property = Property::findOnDB($id);
                // Check if the propery exists then delete it
                if (!is_null($property)) {
                    $property->deleteRow();
                }
            }
        }
    }
}
