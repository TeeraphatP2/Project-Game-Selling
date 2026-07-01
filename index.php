<!DOCTYPE html>
<html class="h-full" lang="en">
<?php include './includes/head.php'; ?>
<body class="flex flex-col min-h-full">
    <?php include './includes/navbar.php'; ?>
    <main class="flex-1 flex flex-col">
        <?php 
        // require './helpers/dd.php';
        ?>
        
        <?php require './routes/web.php'?>

    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>