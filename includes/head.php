<head>
    <?php 
        session_start();
        
        include dirname(__dir__) . '/config/wep.php';
        include BASE_PATH . '/config/conn.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameSellig</title>
    <link rel="stylesheet" href="./assets/css/frontend/index.css">
    <link rel="stylesheet" href="./assets/css/frontend/navbar/navbar.css">
    <link rel="stylesheet" href="./assets/css/frontend/main.css">
    <link rel="stylesheet" href="./assets/css/frontend/footer/footer.css">
    <link rel="stylesheet" href="./assets/css/frontend/login.css">
    <link rel="stylesheet" href="./assets/css/frontend/register.css">
    <link rel="stylesheet" href="./assets/css/frontend/homepage.css">
    <link rel="stylesheet" href="./assets/css/frontend/aboutUs.css">
    <?php 
        $bgPage = $_GET['page'] ?? ""; 
        switch($bgPage) {
            case '':
                echo '<link rel="stylesheet" href="./assets/css/frontend/backgroundBody/homepage.css">';
                break;
            case 'about':
                echo '<link rel="stylesheet" href="./assets/css/frontend/backgroundBody/homepage.css">';
                break;
            case 'login':
                echo '<link rel="stylesheet" href="./assets/css/frontend/backgroundBody/auth.css">';
                break;
            case 'register':
                echo '<link rel="stylesheet" href="./assets/css/frontend/backgroundBody/auth.css">';
                break;
        }
    ?>
    <script src="./assets/js/sweetAleart2/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>