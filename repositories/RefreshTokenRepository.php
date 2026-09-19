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
    public function insertToDatabase(string $refreshTokenHash, int $expireAt)
    {
        
    }
}