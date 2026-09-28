<?php

namespace App\Repositories;
use PDO;
use PDOException;

Class RefreshTokenRepository {
    private PDO $pdo;
    

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function insertToDatabase(string $refreshTokenHash, int $expireAt, string $userId)
    {
        $expiredAt = date('Y:m:d H:i:s', $expireAt);
        try{
            $sql = "INSERT INTO usersrefreshtoken (tokenHash, expiresAt, userId)
                    VALUES (:tokenHash, :expiresAt, :userId)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':tokenHash', $refreshTokenHash, PDO::PARAM_STR);
            $statement->bindParam(':expiresAt', $expiredAt, PDO::PARAM_STR);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();
        }catch(PDOException $e){
            throw new PDOException('PDO_EXCEPTION_ERROR', previous: $e);
        }

    }
}