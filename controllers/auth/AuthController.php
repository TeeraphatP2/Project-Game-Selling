<?php

namespace App\Controllers\Auth;

session_start();

use App\Helpers\Validator;
use App\Helpers\Response;
use Exception;

class AuthController
{
    private \App\Services\AuthService $authService;

    public function __construct(\App\Services\AuthService $authService)
    {
        $this->authService = $authService;
    }

    // รับค่า login จากผู้ใช้
    public function login()
    {
        // เก็บค่าจากที่ api ส่งมา
        $input    = file_get_contents('php://input');
        $userData = json_decode($input, true);

        $email    = $userData['email'];
        $password = $userData['password'];

        //ตรวจว่าค่าที่ input ครบไหม
        if (Validator::isEmptyInput($email) && Validator::isEmptyInput($password)) {
            Response::error('EMPTY_USER_DATA_AUTH');
            die();
        } elseif (Validator::isEmptyInput($email)) {
            Response::error('EMPTY_USER_EMAIL_AUTH');
            die();
        } elseif (Validator::isEmptyInput($password)) {
            Response::error('EMPTY_USER_PASSWORD_AUTH');
            die();
        }

        // เรียกใช้ AuthService
            $result = $this->authService->login($email, $password);

            if ($result['message'] === 'EMAIL_NOT_FOUND') {
                Response::error($result['message']);
                exit();
            }

            if ($result['message'] === 'INVALID_PASSWORD') {
                Response::error($result['message']);
            }


            //login สำเร็จ
            if ($result['message'] === 'LOGIN_SUCCESS') {
                Response::success($result['message'], $result['data']);
                exit();
            }
        exit();
    }

    public function register()
    {
        $input      = file_get_contents('php://input');
        $userData   = json_decode($input, true);

        $firstname  = $userData['firstname'];
        $lastname   = $userData['lastname'];
        $email      = $userData['email'];
        $password   = $userData['password'];
        $cpassword  = $userData['cpassword'];

        //ตรวจว่า input ครบไหม
        if (Validator::isEmptyInput($firstname)) {
            Response::error('EMPTY_INPUT_FORM');
            die();
        } elseif (Validator::isEmptyInput($lastname)) {
            Response::error('EMPTY_INPUT_FORM');
            die();
        } elseif (Validator::isEmptyInput($email)) {
            Response::error('EMPTY_INPUT_FORM');
            die();
        } elseif (Validator::isEmptyInput($password)) {
            Response::error('EMPTY_INPUT_FORM');
            die();
        } elseif (Validator::isEmptyInput($cpassword)) {
            Response::error('EMPTY_INPUT_FORM');
            die();
        }

            // ยืนยันรหัสผ่านตรงกันไหม
            if (!Validator::isPasswordMatch($password, $cpassword)) {
                Response::error('PASSWORD_NOT_MATCH');
                die();
            }
            // email ผิดรูปแบบไหม
            if (!Validator::isValidEmailFormat($email)) {
                Response::error('INVALID_EMAIL_FORMAT');
                die();
            }
            // ชื่อถูกรูปแบบไหม
            if (!Validator::isValidName($firstname)) {
                Response::error('INVALID_FIRSTNAME_USER');
                die();
            }
            // นามสกุลถูกรูปแบบไหม
            if (!Validator::isValidName($lastname)) {
                Response::error('INVALID_LASTNAME_USER');
                die();
            }
                // เรียกใช้ AuthService
                $result = $this->authService->register($userData);

                // มี email นี้ในระบบแล้ว
                if ($result['message'] === 'EMAIL_IS_ALREADY_IN_SYSTEM') {
                    Response::error($result['message']);
                }

                Response::success($result['message']);
                die();
    }
}
