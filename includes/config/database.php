<?php

function connectDB(): mysqli
{
    $user = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $host = $_ENV['DB_HOST'];
    $dbName = $_ENV['DB_NAME'];

    $db = new mysqli($host, $user, $password, $dbName);

    if (!$db) {
        echo "Error en el intento de conexión";
        exit;
    }
    return $db;
}

function closeDB($db)
{
    mysqli_close($db);
}
