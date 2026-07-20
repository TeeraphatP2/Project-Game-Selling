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

        $authHeader = $headers['Authorization'] ?? '';

        if(empty($authHeader)){
            throw new Exception('UNAUTHORIZED');
        }
        if(!str_starts_with($authHeader, 'Bearer ')){
            throw new Exception('UNAUTHORIZED');
        }

        $token = trim(substr($authHeader, 7));

        if(empty($token)){
            throw new Exception('UNAUTHORIZED');
        }
        return $token;
    }

}