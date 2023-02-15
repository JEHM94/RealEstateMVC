<?php
require __DIR__ . '/../vendor/autoload.php';

// Variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'config/database.php';

use Model\ActiveRecord;

// Connect DataBase
$db = connectDB();

// Set DataBase to All Property Instances
ActiveRecord::setDB($db);