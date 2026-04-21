<?php

namespace App\Repositories;


class UserRepository
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
    }

    public function findByEmail(string $email)
    {

        try {
            $statement = $this->pdo->prepare("SELECT firstname, email, `password` FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, \PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {

            return ['message' => 'PDO_EXCEPTION_ERROR','data' => $e->getMessage()];
        }
    }

    public function userLogin(string $email)
    {
        try {
            $statement = $this->pdo->prepare("SELECT firstname, email, `password` FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, \PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {

            return ['message' => 'PDO_EXCEPTION_ERROR','data' => $e->getMessage()];
        }
    }
    public function userRegister(string $firstname, string $lastname, string $email, string $passwordHash){

        try{

            if($this->findByEmail($email)){
                return false;

            }else{
                
                $statement = $this->pdo->prepare
                (
                "INSERT INTO users (firstname, lastname, email, `password`, `role`)
                VALUES (':firstname', ':lastname', ':email', ':password', ':role')"
                );
                $statement->bindParam(':firstname', $firstname, \PDO::PARAM_STR);
                $statement->bindParam(':lastname', $lastname, \PDO::PARAM_STR);
                $statement->bindParam(':email', $email, \PDO::PARAM_STR);
                $statement->bindParam(':password', $passwordHash, \PDO::PARAM_STR);
                $statement->bindParam(':role', 'user', \PDO::PARAM_STR);
                return $statement->execute();
                
            }
        }catch(\PDOException $e){
            
            return ['message' => 'PDO_EXCEPTION_ERROR','data' => $e->getMessage()];
        }
    }
}
