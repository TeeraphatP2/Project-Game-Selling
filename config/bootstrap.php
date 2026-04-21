<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Config\Web;
use App\Database\Connection;
use App\Config\Config;
use App\Controllers\Auth\AuthController;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Config\Container;

$container = new Container();

$container->bind('App\Database\Connection', function() {
    $config = (new Config)->getConfigDatabase();
    return (new Connection($config['database']))->getConnection();
});

$container->bind('App\Repositories\UserRepository', function() use($container) {
    $connection = $container->resolve('App\Database\Connection');
    return new UserRepository($connection);
});

$container->bind('App\Services\AuthService', function() use($container) {
    $userRepo = $container->resolve('App\Repositories\UserRepository');
    return new AuthService($userRepo);
});

$container->bind('App\Controllers\Auth\AuthController', function() use($container) {
    $authService = $container->resolve('App\Services\AuthService');
    return new AuthController($authService);
});

Web::setContainer($container);

