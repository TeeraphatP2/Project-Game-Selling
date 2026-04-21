<?php
namespace App\Database;


Class Connection {
    
    private static ?Connection $instance = null;
    private \PDO $pdo;

    public function __construct(array $config){
        // $config = (new Config())->getConfigDatabase();
        $dsn = 'mysql:'. http_build_query($config, '', ';');
        try{
            $this->pdo = new \PDO($dsn, 'root', '');
        }catch(\PDOException $e){
            echo 'Connection Failed' . $e->getMessage();    
        // return $e->getMessage();
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