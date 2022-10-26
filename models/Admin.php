<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Database
    protected static $table = 'users';
    protected static $DBcolumns = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    // Constructor
    public function __construct($array = [])
    {
        $this->id = $array['id'] ?? null;
        $this->email = $array['email'] ?? '';
        $this->password = $array['password'] ?? '';
    }

    public function validate()
    {
        if (!$this->email) {
            self::$errors[] = "El email es obligatorio o no es válido";
        }

        if (!$this->password) {
            self::$errors[] = "La contraseña es obligatoria";
        }

        return self::$errors;
    }

    public function userExists()
    {
        // Check if the User extist
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if (!$result->num_rows) {
            self::$errors[] = "El usuario no existe";
            return;
        }
        return $result;
    }

    public function verifyPassword($result)
    {
        $user = $result->fetch_object();

        $auth = password_verify($this->password, $user->password);

        if (!$auth) {
            self::$errors[] = "Contraseña Incorrecta";
        }

        return $auth;
    }
    public function authenticate()
    {
        session_start();
        // Fill Session with user cedentials
        $_SESSION['user'] = $this->email;
        $_SESSION['login'] = true;
        // Send the User to Admin site
        header('Location: /admin');
    }
}
