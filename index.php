<!DOCTYPE html>
<html lang="en">
<?php include './includes/head.php'; ?>
<body>
    <?php include './includes/navbar.php'; ?>
    <main class="layout-main">
        <?php
        $page = $_GET['page'] ?? "";
        switch ($page) {
            case '':
                include './page/homepage.php';
                break;
            case 'about';
                include './page/about.php';
                break;
            case 'login':
                include './page/login/login.php';
                break;
            case 'register':
                include './page/register/register.php';
                break;
        }
        ?>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>