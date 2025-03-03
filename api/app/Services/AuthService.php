<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private $userRepository;
    private $secretKey;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->secretKey = $_SESSION["JWT_SECRET"];
    }

    public function login($username, $password)
    {
        $user = $this->userRepository->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new \Exception('Invalid credentials');
        }

        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'user_id' => $user['id'],
            'username' => $user['username']
        ];

        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

        return $jwt;
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            throw new \Exception('Invalid token');
        }
    }
}
