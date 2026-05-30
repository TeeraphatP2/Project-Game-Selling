<?php
namespace App\Middleware;

use App\Services\JwtService;
use Exception;

class AuthMiddleware {
    private JwtService $jwtService;

    public function __construct(JwtService $jwtService){
        $this->jwtService = $jwtService;
    }

    public function handle(): object 
    {
        $token = $this->extractToken();
        return $this->jwtService->verifyAccessToken($token);
    }

    public function handleRefresh(): object
    {
        $token = $this->extractToken();
        return $this->jwtService->verifyRefreshToken($token);
    }
    private function extractToken(): string
    {
        $headers = getallheaders();

        $authHeader = $headers['Authorization'];

        if(empty($authHeader)){
            throw new Exception('UNTHORIZED');
        }
        if(!str_starts_with($authHeader, 'Bearer ')){
            throw new Exception('UNTHORIZED');
        }

        $token = trim(substr($authHeader, 7));

        if(empty($token)){
            throw new Exception('UNTHORIZED');
        }
        return $token;
    }

    //  // ✅ ใช้กับ route ที่จำกัดเฉพาะ role เช่น admin
    // public function handleWithRole(string ...$allowedRoles): object
    // {
    //     $decoded  = $this->handle();
    //     $userRole = $decoded->role ?? null;

    //     if (!in_array($userRole, $allowedRoles)) {
    //         Response::error('FORBIDDEN');
    //     }

    //     return $decoded;
    // }

     // ✅ ใช้กับ route ที่จำกัดเฉพาะ role เช่น admin
    // public function handleWithRole(string ...$allowedRoles): object
    // {
    //     $decoded  = $this->handle();
    //     $userRole = $decoded->role ?? null;

    //     if (!in_array($userRole, $allowedRoles)) {
    //         Response::error('FORBIDDEN');
    //     }

    //     return $decoded;
    // }
}