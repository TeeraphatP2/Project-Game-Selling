<?php

namespace App\Repositories;

use PDOException;
//  query สำหรับ users
class UserRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
    }
    // หาข้อมูล user ผ่าน email
    public function findByEmail(string $email): ?array
    {
        try {
            $statement = $this->pdo->prepare("SELECT userId, firstname, email, `password` FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, \PDO::PARAM_STR);
            $statement->execute();
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);

            if($userData === false){
                return null;
            }

            return $userData;
        }catch (PDOException $e) {
    // ส่ง error code พร้อมข้อความ error เมื่อ query ผิดผลาด
            throw new PDOException('PDO_EXCEPTION_ERROR', previous: $e);
            // throw new \RuntimeException('PDO_EXCEPTION_ERROR', 0, $e);
        }
    }

    // ระบบล็อคอิน
    public function userLogin(string $email): ?array
    {
        try {
            $statement = $this->pdo->prepare("SELECT firstname, email, `password` FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, \PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(\PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            throw new PDOException('PDO_EXCEPTION_ERROR', previous: $e);
        }
    }

    // ระบบสมัครสมาชิก
    public function userRegister(string $firstname, string $lastname, string $email, string $passwordHash): bool
    {

        try{

            if($this->findByEmail($email)){
                return false;
            }else{
                $statement = $this->pdo->prepare
                (
                "INSERT INTO users (firstname, lastname, email, `password`, `role`)
                VALUES (:firstname, :lastname, :email, :password, :role)"
                );
                $statement->bindParam(':firstname', $firstname, \PDO::PARAM_STR);
                $statement->bindParam(':lastname', $lastname, \PDO::PARAM_STR);
                $statement->bindParam(':email', $email, \PDO::PARAM_STR);
                $statement->bindParam(':password', $passwordHash, \PDO::PARAM_STR);
                $statement->bindValue(':role', 'user', \PDO::PARAM_STR);
                return $statement->execute();
            }

        }catch(PDOException $e){
    // ส่ง error code พร้อมข้อความ error เมื่อ query ผิดผลาด
            throw new PDOException('PDO_EXCEPTION_ERROR', previous: $e);
        }
    }
}