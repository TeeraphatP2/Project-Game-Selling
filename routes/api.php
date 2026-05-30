<?php
use App\Helpers\Response;

// เก็บ request method
$method = $_SERVER['REQUEST_METHOD'];

// เก็บ query server
parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $params);
$action = $params['action'] ?? '';

// เก็บ class
$routes = [
    'POST' => [
        'login' => fn() => $container->resolve('App\Controllers\Auth\AuthController')->login(),
        'register' => fn() => $container->resolve('App\Controllers\Auth\AuthController')->register()
    ]
];

// เรียกใช้งาน class
if (isset($routes[$method][$action])) {
    $routes[$method][$action]();
    
} else {
    Response::error('ROUTE_NOT_FOUND');
}