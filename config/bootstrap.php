<?php
// เรียกใช้ package dotEnv
$dotenv             = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// use App\Config\Web;
use App\Database\Connection;
use App\Config\Config;
use App\Controllers\Auth\AuthController;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Config\Container;
use App\Services\JwtService;
use App\Helpers\ExceptionHandler;
// ตรวจและส่ง Exception
set_exception_handler([ExceptionHandler::class, 'handle']);

$container          = new Container();

// เก็บการเรียกใช้ connect database
$container->bind(Connection::class, function() {
    $config         = (new Config)->getConfigDatabase();
    return (new Connection($config['database']))->getConnection();
});

// เก็บการเรียกใช้ UserRepository
$container->bind(UserRepository::class, function() use($container) {
    $connection     = $container->resolve(Connection::class);
    return new UserRepository($connection);
});

// เก็บการเรียกใช้ JwtService
$container->bind(JwtService::class, function() {
    return new JwtService();
});

// เก็บการเรียกใช้ AuthService
$container->bind(AuthService::class, function() use($container) {
    $userRepo       = $container->resolve(UserRepository::class);
    $jwtService     = $container->resolve(JwtService::class);
    return new AuthService($userRepo, $jwtService);
});

// เก็บการเรียกใช้ AuthService
$container->bind(AuthController::class, function() use($container) {
    $authService    = $container->resolve('App\Services\AuthService');
    return new AuthController($authService);
});


// Web::setContainer($container);