<?php

namespace App\Helpers;

Class Response{
    
    // เก็บ Message
    private const Message = [
        'EMAIL_NOT_FOUND'            => 'ไม่มีอีเมลนี้ในระบบ',
        'INVALID_PASSWORD'           => 'รหัสผ่านไม่ถูกต้อง',
        'EMPTY_USER_DATA_AUTH'       => 'กรุณากรอกข้อมูลให้ครบ',
        'EMPTY_USER_EMAIL_AUTH'      => 'กรุณากรอกอีเมล',
        'EMPTY_USER_PASSWORD_AUTH'   => 'กรุณากรอกรหัสผ่าน',
        'LOGIN_SUCCESS'              => 'เข้าสู่ระบบสำเร็จ',
        'REGISTER_SUCCESS'           => 'สมัครสมาชิกสำเร็จ',
        'INVALID_EMAIL_FORMAT'       => 'รูปแบบอีเมลไม่ถูกต้อง',
        'INVALID_FIRSTNAME_USER'     => 'ชื่อมีอักขระที่ห้ามใช้',
        'INVALID_LASTNAME_USER'      => 'นามสกุลมีอักขระที่ห้ามใช้',
        'PDO_EXCEPTION_ERROR'        => 'เชื่อมต่อฐานข้อมูลผิดผลาด',
        'EMAIL_IS_ALREADY_IN_SYSTEM' => 'คุณมีบัญขีอยู่ในระบบอยู่แล้ว',
        'PASSWORD_NOT_MATCH'         => 'รหัสผ่านไม่ตรงกัน',
        'EMPTY_INPUT_FORM'           => 'กรุณากรอกให้มูลให้ครบ',
        'MISSING_REQUIRED_ENV'       => 'ไม่พบ ENV ที่เรียก',
        'ROUTE_NOT_FOUND'            => 'ไม่พบคลาสที่เรียกใช้จาก Api',
        'UNTHORIZED'                 => 'กรุณาเข้าสู่ระบบก่อน'

    ];

    // จัดการแสดงข้อมูล Error
    public static function error(string $message, $data = null):void
    {

        echo json_encode([
            'status'   => false,
            'message'  => self::Message[$message] ?? $message,
            'data'     => $data
        ]);
        exit();
    }

    // จัดการแสดงข้อมูล Success
    public static function success(string $message, $data = null):void 
    {

        echo json_encode([
            'status'   => true,
            'message'  => self::Message[$message] ?? $message,
            'data'     => $data
        ]);
        exit();
    }
        

}