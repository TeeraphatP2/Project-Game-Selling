<?php

namespace App\Controllers\Auth;

session_start();

use App\Helpers\Validator;

use App\Helpers\Response;

class AuthController
{
    private $authService;

    public function __construct($authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        
        $input    = file_get_contents('php://input');
        $userData = json_decode($input, true);

        $email    = $userData['email'];
        $password = $userData['password'];

        if (empty($email) && empty($password)) {
            Response::error('EMPTY_USER_DATA_AUTH');
            die();
        } elseif (empty($email)) {
            Response::error('EMPTY_USER_EMAIL_AUTH');
            die();
        } elseif (empty($password)) {
            Response::error('EMPTY_USER_PASSWORD_AUTH');
            die();
        }

        $result = $this->authService->login($email, $password);

        if($result['message'] === 'PDO_EXCEPTION_ERROR'){
            Response::error($result['message'], $result['data']);
            exit();
        }

        if ($result['message'] === 'LOGIN_SUCCESS') {
            $_SESSION['login'] = $result['data']['firstname'];
            Response::success($result['message'], $result['data']);
            exit();
        }
        exit();
    }

    public function register()
    {
        $input = file_get_contents('php://input');
        $userData = json_decode($input, true);

        $firstname = $userData['firstname'];
        $lastname = $userData['lastname'];
        $email = $userData['email'];
        $password = $userData['password'];
        $cpassword = $userData['cpassword'];

        if(Validator::isEmptyInput($firstname)){
            Response::error('EMPTY_INPUT_FORM');
            die();
        }elseif(Validator::isEmptyInput($lastname)){
            Response::error('EMPTY_INPUT_FORM');
            die();
        }
        elseif(Validator::isEmptyInput($email)){
            Response::error('EMPTY_INPUT_FORM');
            die();
        }
        elseif(Validator::isEmptyInput($password)){
            Response::error('EMPTY_INPUT_FORM');
            die();
        }
        elseif(Validator::isEmptyInput($cpassword)){
            Response::error('EMPTY_INPUT_FORM');
            die();
        }

        if(!Validator::isPasswordMatch($password, $cpassword)){
            Response::error('PASSWORD_NOT_MATCH');
            die();
        }

        if(!Validator::isValidEmailFormat($email)){
            Response::error('INVALID_EMAIL_FORMAT');
            die();
        }

        if(!Validator::isValidName($firstname)){
            Response::error('INVALID_FIRSTNAME_USER');
            die();
        }

        if(!Validator::isValidName($lastname)){
            Response::error('INVALID_LASTNAME_USER');
            die();
        }

        $result = $this->authService->register($userData);

        if($result['message'] === 'EMAIL_IS_ALREADY_IN_SYSTEM'){
            Response::error($result['message']);
        }

        //echo json_encode(['data' => [$firstname, $lastname, $email, $password, $cpassword]]);
        die();
    }
}




































// try{
// $query_check_email      = "SELECT firstname, email, `password` FROM users WHERE email = :email";
// $stmt_query_check_email = $conn->prepare($query_check_email);
// $stmt_query_check_email->bindParam(':email', $email, PDO::PARAM_STR);
// $stmt_query_check_email->execute();
// $call_back_check_email  = $stmt_query_check_email->fetch(PDO::FETCH_ASSOC);

// if($call_back_check_email['email'] == $email){
//     $hash = $call_back_check_email['password'];

//     if(password_verify($password, $hash)){
//         echo json_encode(["status" => "success", "firstname" => $call_back_check_email['firstname']]);
//         exit();
//     }else{
//         echo json_encode(["massage" => "รหัสผ่านไม่ถูกต้อง"]);
//         exit();
//     }
// }
// }catch(PDOException $e){
//     echo json_encode(["Query Error" => "dsdsd"]);
//     die();
// }