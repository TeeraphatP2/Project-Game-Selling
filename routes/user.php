<?php
$page               = parse_url($_SERVER['REQUEST_URI'])['query'] ?? '';

$router = [
    ''              => './page/homepage.php',
    'page=about'    => './page/about.php',
    'page=login'    => './page/login/login.php',
    'page=register' => './page/register/register.php'
];


if(array_key_exists($page, $router)) {
    require $router[$page];
}
