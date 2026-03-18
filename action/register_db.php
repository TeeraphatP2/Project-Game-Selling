<?php
//ระบบRegister
session_start();
$conn = require dirname(__dir__) . '/config/conn.php';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['cpassword'])) {

    $username = ($_POST['username']); //เก็บข้อมูลไว้ที่ส่งมาไว้ในตัวแปร
    $email = ($_POST['email']);
    $firstname = ($_POST['firstname']);
    $lastname = ($_POST['lastname']);
    $password1 = ($_POST['password']);
    $cpassword1 = ($_POST['cpassword']);

    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอก username";
        die(header('Location: ../?page=register')); //ไม่ได้กรอก username
    } elseif (empty($email)) {
        $_SESSION['error'] = "กรุณากรอก email";
        die(header('Location: ../?page=register')); //ไม่ได้กรอก email
    } elseif (empty($firstname)) {
        $_SESSION['error'] = "กรุณากรอก firstname";
        die(header('Location: ../?page=register')); //ไม่ได้กรอก firstname
    } elseif (empty($lastname)) {
        $_SESSION['error'] = "กรุณากรอก lastname";
        die(header('Location: ../?page=register')); //ไม่ได้กรอก lastname
    } elseif (empty($password1)) {
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        die(header('Location: ../?page=register')); //ไม่ได้กรอกรหัสผ่าน
    } elseif (empty($cpassword1)) {
        $_SESSION['error'] = "กรุณากรอกยืนยันรหัสผ่าน";
        die(header('Location: ../?page=register')); //ไม่ได้กรอกยืนยันรหัสผ่าน
    } elseif ($password1 != $cpassword1) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        die(header('Location: ../?page=register')); //รหัสผ่านไม่ตรงกัน
    } else {

        try {
            $query_check_email = "SELECT Email FROM users WHERE Email = :email"; //เช็คว่ามีผู้ใช้อีเมลนี้หรือ่ยัง
            $stmt_query_check_email = $conn->prepare($query_check_email);
            $stmt_query_check_email->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_query_check_email->execute([':email' => $email]);
            $check_email_duplicate = $stmt_query_check_email->fetch(PDO::FETCH_ASSOC)['email'];
            
            if ($check_email_duplicate == $email) { // ตรวจสอบว่ามี email ซ้ำหรือไม่
                $_SESSION['error'] = "มี Email นี้อยู่ในระบบอยู่แล้ว";
                die(header('Location: ../?page=register')); //มีผู้ใช้อีเมลนี้อยู่แล้ว
            } else {
                $algo = PASSWORD_ARGON2ID;
                $options = [
                    'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                    'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                    'threads' => PASSWORD_ARGON2_DEFAULT_THREADS
                ];

                $password = password_hash($password1, $algo, $options); //เอาหรัสผ่านรหัสแบบARGON2ID
                $query_create_account = "INSERT INTO users (firstName, lastName, email, Passwords, `role`)
            VALUES (:firstname, :lastname, :email, :password, :role)";
                $call_back_create_account = $conn->prepare($query_create_account); //สร้างบัญชี
                $call_back_create_account->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $call_back_create_account->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                 $call_back_create_account->bindParam(':password', $password, PDO::PARAM_STR);
                $call_back_create_account->bindParam(':email', $email, PDO::PARAM_STR);
                $call_back_create_account->bindValue(':role', 'user', PDO::PARAM_STR);
                $call_back_create_account->execute();
                if ($call_back_create_account) {
                    $_SESSION['success'] = 'สมัครสมาชิกสำเร็จ';
                    die(header('Location: ../?page=login')); //สมัครสมาชิกสำเร็จ
                } else {
                    $_SESSION['error'] = 'สมัครสมาชิกล้มเหลว';
                    die(header('Location: ../?page=register')); //สมัครสมาขิกล้มเหลว
                }
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
} else {
    $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    header('Location: ../?page=register');
}
