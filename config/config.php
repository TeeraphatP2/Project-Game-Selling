<?php

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'game_selling_db',
        'charset' => 'utf8mb4'
    ]
];



// old config database
// if(in_array("mysql",PDO::getAvailableDrivers())){
//     echo "You have PDO for MySQL driver installed";
// }else{
//     echo "PDO driver for MySQL is not installed in your system";
// }
// $host = "localhost";
// $db = "game_selling_db";
// $user = "root";
// $password = "";