<?php

$method = $_SERVER['REQUEST_METHOD'];

$action = parse_url($_SERVER['REQUEST_URI'])['query'];

$routes = [
    'POST' => [
        'action=login' => fn() => $container->resolve('App\Controllers\Auth\AuthController')->login(),
        'action=register' => fn() => $container->resolve('App\Controllers\Auth\AuthController')->register()
    ]
];

if (isset($routes[$method][$action])) {
    $routes[$method][$action]();
    
} else {
    echo json_encode(['status' => false, 'message' => 'Route not found']);
}