<?php
namespace App\helpers;

// ระบบตรวจสอบความถูกต้อง
class Validator{

    // ตรวจ email format
    public static function isValidEmailFormat(string $email):bool {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }

    // ตรวจคำถูกต้องของชื่อ
    public static function isValidName(string $name):bool {
        if(!preg_match("/^[a-zA-Zก-๙\s'-]+$/u", $name)){
            return false;
        }else{
            return true;
        }
    }

    // ยืนยันรหัสผ่าน
    public static function isPasswordMatch(string $password, string $cpassword){
        if($password !== $cpassword){
            return false;
        }else{
            return true;
        }
    }

    // ตรวจ input ว่ามีค่าว่างไหม
    public static function isEmptyInput($data){
        if(!empty($data)){
            return false;
        }else{
            return true;
        }
    }
    
}