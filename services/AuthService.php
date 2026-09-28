<?php
namespace App\Services;

Class AuthService{

    private \App\Repositories\UserRepository $userRepo;
    private \App\Services\JwtService $jwtService;
    private \App\Repositories\RefreshTokenRepository $refreshTokenRepo;
    public function __construct(\App\Repositories\UserRepository $userRepo, \App\Services\JwtService $jwtService, \App\Repositories\RefreshTokenRepository $refreshTokenRepo) 
    {
        $this->userRepo             = $userRepo;
        $this->jwtService           = $jwtService;
        $this->refreshTokenRepo     = $refreshTokenRepo;
    }   

    // ระบบล็อคอิน
    public function login(string $email, string $password): array
    {
        
        $user                       = $this->userRepo->findByEmail($email);

        if($user === null){
            
            return ['message' => 'EMAIL_NOT_FOUND'];
        }
        $hash = $user['password'];
        if(!password_verify($password, $hash)){
            return ['message' => 'INVALID_PASSWORD'];
            
        }

        $algo                       = PASSWORD_BCRYPT;       
        $options = [
        // Increase the bcrypt cost from 12 to 13.
            'cost'                  => 13,
        ];

        $refreshTokenData = $this->jwtService->createRefreshToken($user['userId']);
        $refreshToken = $refreshTokenData[0];
        $expireAt = $refreshTokenData[1];
        $userId = $refreshTokenData[2];
        $refreshTokenHash = password_hash($refreshToken, $algo, $options);

        $this->refreshTokenRepo->insertToDatabase($refreshTokenHash, $expireAt, $userId);
        
        return ['message' => 'LOGIN_SUCCESS', 'data' => [$this->jwtService->createAccessToken([$user['userId'], $user['firstname']])]];
    }
    
    // ระบบสมัครสมาชิก
    public function register(array $userData): array
    {
        $firstname                  = $userData['firstname'];
        $lastname                   = $userData['lastname'];
        $email                      = $userData['email'];
        $password                   = $userData['password'];

        $algo                       = PASSWORD_BCRYPT;       
        $options = [
        // Increase the bcrypt cost from 12 to 13.
            'cost'                  => 13,
        ];
        $passwordHash               = password_hash($password, $algo, $options);
        
        // เรียก query
        $userRegister               = $this->userRepo->userRegister($firstname, $lastname, $email, $passwordHash);

        if(!$userRegister){
            return ['message'       => 'EMAIL_IS_ALREADY_IN_SYSTEM'];
        }
        return ['message'       => 'REGISTER_SUCCESS'];
    }
}