<?php
namespace App\Database;


Class Connection {
    
    private static ?Connection $instance = null;
    private \PDO $pdo;

    public function __construct(array $config){
        $dsn = 'mysql:'. http_build_query($config, '', ';');
        $options = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00'",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];
        try{
            $this->pdo = new \PDO($dsn, 'root', '', $options);
            
        }catch(\PDOException $e){
            
            throw new \PDOException('CONNECT_DATABASE_ERROR', previous: $e);
            
        }
    }

    // public static function getInstance():self {
    //     if(self::$instance === null){
    //         self::$instance = new self();
    //     }
    //     return self::$instance;
    // }

    public function getConnection():\PDO {
        return $this->pdo;
    }
}