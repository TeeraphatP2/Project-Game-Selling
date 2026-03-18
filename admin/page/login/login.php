<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../dist/css/login/login.css">
    <title>Login Admin Page</title>
</head>

<body>
    <div class="container-login-admin">
        <div class="card-login">
            <h2>Admin Panel</h2>
            <?php
            if (isset($_SESSION['error'])) { ?>
                <h3>
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </h3>
            <?php } ?>
            <div class="input-container">
                <form action="../../../action/admin_action/login_db.php" method="post">
                    <fieldset>
                        <label for="email_admin">Email</label>
                        <input type="email" name="email_admin" id="email_admin" required>
                    </fieldset>
                    <fieldset>
                        <label for="password_admin">Password</label>
                        <input type="password" name="password_admin" id="password_admin" required>
                    </fieldset>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>