<head>
    
    <?php
    session_start(); 
    require '../config/conn.php';
    if(!isset($_SESSION['login'])) {
        die(header("Location: ./page/login/login.php"));
    } 
    
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/css/sidebar/sidebar.css">
    <link rel="stylesheet" href="./dist/css/index.css">
    <link rel="stylesheet" href="./dist/css/main.css">
    <link rel="stylesheet" href="./dist/css/navbar.css">
    <title>Admin Panel</title>
</head>