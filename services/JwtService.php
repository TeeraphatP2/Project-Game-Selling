<?php 

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use RuntimeException;
use InvalidArgumentException;
use App\Helpers\Response;

// สร้าง Json Web service
Class JwtService {
    private string $accessSecretKey;
    private string $refreshSecretKey;
    private int $accessTime;
    private int $refreshTime;
    
    public function __construct()
    {
        $this->accessSecretKey      = (string) $this->requireEnv('ACCESS_SECRET_TOKEN');
        $this->refreshSecretKey     = (string) $this->requireEnv('REFRESH_SECRET_TOKEN');
        $this->accessTime           = (int) $this->requireEnv('ACCESS_TIME');
        $this->refreshTime          = (int) $this->requireEnv('REFRESH_TIME');

    }

    // เรียกไฟล์ .Env
    private function requireEnv(string $key): string
    {
        $value                      = $_ENV[$key] ?? null;

        if(empty($value)){
            throw new RuntimeException('MISSING_REQUIRED_ENV', previous: $value);
        }
        return $value;
    }

    //สร้างโทเค็น
    public function createAccessToken(array $claims): string
    {

        return $this->encode($claims, $this->accessSecretKey, $this->accessTime);
    }

    // รีเซ็ทโทเค็น
    public function createRefreshToken(int|string $userId): string
    {
        return $this->encode(['sub' => $userId], $this->refreshSecretKey, $this->refreshTime);
    }

    //ตรวจสอบ Access token
    public function verifyAccessToken(string $token): object 
    {
        return $this->decode($token, $this->accessSecretKey);
    }

    //ตรวจสอบ Refresh token
    public function verifyRefreshToken(string $token): object
    {
        return $this->decode($token, $this->refreshSecretKey);
    }

    //ระบบสร้างโทเค็น
    private function encode(array $claims, string $accessKey, int $accessTime): string 
    {
        $now = time();

        $payload = array_merge($claims, [
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + $accessTime
        ]);

        return JWT::encode($payload, $accessKey, 'HS256');
    }

    //ระบบตรวจสอบโทเค็น
    private function decode(string $token, string $refreshKey)
    {
        try {
            return JWT::decode($token, new Key($refreshKey, 'HS256'));
        }catch(ExpiredException $e){
            Response::error('TOKEN_EXPIRED', $e->getMessage());
        }catch(SignatureInvalidException $e){
            Response::error('TOKEN_SIGNATURE_INVALID', $e->getMessage());
        }catch(\Exception $e){
            Response::error('TOKEN_INVALID', $e->getMessage());
        }
    }
}