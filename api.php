<?php
ini_set('display_errors', 0);
// error_reporting(E_ALL);
require_once __DIR__ . '/vendor/autoload.php';
require './helpers/dd.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require './config/bootstrap.php';


require './routes/api.php';




















// if($_SERVER['REQUEST_METHOD'] == 'POST'){
// echo json_encode(["message" => "Test"]);
// die();
// }
// $loader = require __DIR__ . '/vendor/autoload.php';
// var_dump($loader->getPrefixesPsr4());
// var_dump(class_exists('App\Controllers\Auth\AuthController'));
// var_dump(file_exists(__DIR__ . '/controllers/auth/AuthController.php'));