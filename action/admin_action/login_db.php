<?php
session_start();
require_once '../../config/conn.php';

if (isset($_POST['email_admin']) && isset($_POST['password_admin'])) { //ตวรจสอบว่าได้กรอกข้อมูลไหม
    $email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email_admin']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password_admin']));

    $query_check_login_admin = "SELECT * FROM users WHERE Email = '$email'";
    $call_back_check_query = mysqli_query($conn, $query_check_login_admin);
    if (mysqli_num_rows($call_back_check_query) == 1) { //ตรวจสอบว่ามีข้อมูลในระบบไหม
        $result_query_login = mysqli_fetch_assoc($call_back_check_query); //ดึงข้อมูลแอดมิน
        $hash = $result_query_login['UPassword'];
        $password = $password . $result_query_login['Salt'];

        if(password_verify($password,$hash)) { //ตรวจสอบรหัสผ่าน
            if($result_query_login['RoleU'] == "admin") { //ตรวจสอบว่าเป็นแอดมินไหม
                $_SESSION['login'] = "login";
                die(header("Location: ../../admin")); //ตรวจสอบเสร็จเข้าหน้าแอดมิน
            }else{
                $_SESSION['error'] = "คุณไม่ได้เป็นแอดมินไม่สามารถเข้าระบบได้";
                die(header("Location: ../../admin/page/login/login.php")); //ไม่ได้เป็น admin
            }
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
            die(header("Location: ../../admin/page/login/login.php")); //รหัสผ่านผิด
        } 
    } else {
        $_SESSION['error'] = "อีเมลไม่ถูกต้อง";
        die(header("Location: ../../admin/page/login/login.php")); //อีเมลผิด
    } 
}
?>