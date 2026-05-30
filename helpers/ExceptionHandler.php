<?php

namespace App\Helpers;

use Throwable;
use App\Helpers\Response;

Class ExceptionHandler
{
    public static function handle(Throwable $e):void
    {
        
        error_log(date('[Y-m-d H:i:s] ') . $e->getPrevious() . PHP_EOL, 3, dirname(__DIR__) . '/logs/error.log');

        if($e->getMessage() === 'PDO_EXCEPTION_ERROR'){
            Response::error('PDO_EXCEPTION_ERROR');
            die();
        }

        if($e->getMessage() === 'CONNECT_DATABASE_ERROR'){
            Response::error('CONNECT_DATABASE_ERROR');
            die();
        }

        Response::error($e->getMessage());
        die();
    }
}