<?php
namespace App\Database;


Class Connection {
    
    private static ?Connection $instance = null;
    private \PDO $pdo;

    public function __construct(array $config){
        $dsn = 'mysql:'. http_build_query($config, '', ';');
        try{
            $this->pdo = new \PDO($dsn, 'root', '');
        }catch(\PDOException $e){
            
            throw new \PDOException('CONNECT_DATABASE_ERROR', previous: $e);
            //throw new \RuntimeException('CONNECT_DATABASE_ERROR', 0, $e);
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