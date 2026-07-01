<?php
$bgPage                 = parse_url($_SERVER['REQUEST_URI'])['query'] ?? "";

$routesBackground = [
        ''              => '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/homepage.css">',
        'views=about'    => '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/homepage.css">',
        'views=login'    => '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/auth.css">',
        'views=register' => '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/auth.css">'
];

if(array_key_exists($bgPage, $routesBackground)) {
        echo $routesBackground[$bgPage];
}


// old route background
// switch($bgPage) {
        //     case '':
        //         echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/homepage.css">';
        //         break;
        //     case 'about':
        //         echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/homepage.css">';
        //         break;
        //     case 'login':
        //         echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/auth.css">';
        //         break;
        //     case 'register':
        //         echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/frontend/backgroundBody/auth.css">';
        //         break;
        // }
