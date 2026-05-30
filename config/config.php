<?php

namespace App\Config;

class Config
{
    // Config database
    public function getConfigDatabase()
    {
        return [
            'database' => [
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'game_selling_db',
                'charset' => 'utf8mb4'
            ]
        ];
    }
}
