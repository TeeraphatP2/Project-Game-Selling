<head>
    <?php 
        session_start();
        
        include dirname(__dir__) . '/config/paths.php';
        // include BASE_PATH . '/database/Connection.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameSellig</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/index.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/navbar/navbar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/main.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/footer/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/login.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/register.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/frontend/aboutUs.css">
    <?php  require BASE_PATH .'/includes/userBackground.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/sweetAleart2/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>