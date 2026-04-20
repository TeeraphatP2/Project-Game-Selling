<?php
namespace App\helpers;


class Validator{

    public static function isValidEmailFormat(string $email):bool {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }
    public static function isValidName(string $name):bool {
        if(!preg_match("/^[a-zA-Zก-๙\s'-]+$/u", $name)){
            return false;
        }else{
            return true;
        }
    }
    public static function isPasswordMatch(string $password, string $cpassword){
        if($password !== $cpassword){
            return false;
        }else{
            return true;
        }
    }

    public static function isEmptyInput($data){
        if(!empty($data)){
            return false;
        }else{
            return true;
        }
    }
    
}