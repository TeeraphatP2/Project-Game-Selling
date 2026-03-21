<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
session_start();
$conn = require dirname(__dir__) . '/config/conn.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$email = $data['email'];
$password = $data['password'];

if(empty($email) && empty($password)){
    echo json_encode(["massage" => "กรุณากรอกข้อมูลให้ครบทุกช่อง"]);
    die();
}elseif(empty($email)){
    echo json_encode(["massage" => "กรุณากรอกอีเมล"]);
    die();
}elseif(empty($password)){
    echo json_encode(["massage" => "กรุณากรอกรหัสผ่าน"]);
    die();
}

try{
$query_check_email = "SELECT firstname, email, `password` FROM users WHERE email = :email";
$stmt_query_check_email = $conn->prepare($query_check_email);
$stmt_query_check_email->bindParam(':email', $email, PDO::PARAM_STR);
$stmt_query_check_email->execute();
$call_back_check_email = $stmt_query_check_email->fetch(PDO::FETCH_ASSOC);
if($call_back_check_email['email'] == $email){
    $hash = $call_back_check_email['password'];

    if(password_verify($password, $hash)){
        $_SESSION['success'] = $call_back_check_email['firstname'];
        header("Location: ../?page=login");
        die();
    }else{
        echo json_encode(["massage" => "รหัสผ่านไม่ถูกต้อง"]);
        exit();
    }
}
}catch(PDOException $e){
    echo json_encode(["Query Error" => $e]);
    die();
}