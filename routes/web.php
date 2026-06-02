<?php

// Routing ลิงค์ไปหน้าต่างตาม Request
$page                = parse_url($_SERVER['REQUEST_URI'])['query'] ?? '';

$router = [
    ''               => './views/homepage.php',
    'views=about'     => './views/about.php',
    'views=login'    => './views/login/login.php',
    'views=register' => './views/register/register.php'
];

if(array_key_exists($page, $router)) {
    require $router[$page];
}
