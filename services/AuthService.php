<?php
namespace App\Services;



Class AuthService{

    private $userRepo;

    public function __construct($userRepo) {
        $this->userRepo = $userRepo;
    }

    public function login(string $email, string $password){
        $user = $this->userRepo->findByEmail($email);

        if(isset($user['message']) === 'PDO_EXCEPTION_ERROR'){
            return $user;
        }

        if($user['email'] === $email){
            $hash = $user['password'];
            if(password_verify($password, $hash)){
                return ['message'=> 'LOGIN_SUCCESS', 'data' => $user];
            }else{
                return ['message' => 'INVALID_PASSWORD'];
            }

        }else{
            return ['message' => 'EMAIL_NOT_FOUND'];
        }
    }

    public function register(array $userData){
        $firstname = $userData['firstname'];
        $lastname = $userData['lastname'];
        $email = $userData['email'];
        $password = $userData['password'];

        $algo = PASSWORD_BCRYPT;
                
        $options = [
            // Increase the bcrypt cost from 12 to 13.
            'cost' => 13,
        ];

        $passwordHash = password_hash($password, $algo, $options);

        $userRegister = $this->userRepo->userRegister($firstname, $lastname, $email, $passwordHash);
        if(!$userRegister){
            return ['message' => 'EMAIL_IS_ALREADY_IN_SYSTEM'];
        }else{
            return ['message' => 'REGISTER_SUCCESS'];
        }

    }
}