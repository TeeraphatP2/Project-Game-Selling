<?php
session_start();
$conn = require dirname(__dir__) . '/config/conn.php';
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        $_SESSION['error'] = "ไม่มี email นี้ในระบบ";
        die(header("Location: ../?page=login"));
    }
    $query_gmail_account = "SELECT * FROM users WHERE email = :email";
    $stmt_check_email = $conn->prepare($query_gmail_account);
    $stmt_check_email->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

    if ($result_check_email['email'] == $email) {
        $hash = $result_check_email['passwords'];
        if (password_verify($password, $hash)) {
            if ($result_chack_email['role'] == "admin") {
                $_SESSION['success'] = "กรุณากรอกข้อมูลแอดมินอีกครั้ง";
                exit(header("Location: ../admin"));
            } else {
                $_SESSION['success'] = "ยินดีต้อนรับ";
                exit(header("Location: ../"));
            }
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้องกรุณาลองใหม่อีกครั้ง";
            die(header("Location: ../?page=login"));
        }
    } else {
        $_SESSION['error'] = "ไม่มี email นี้ในระบบ";
        die(header("Location: ../?page=login"));
    }
} else {
    $_SESSION['error'] = 'กรอกข้อมูลไม่ครบ';
    die(header("Location: ../?page=login"));
}
