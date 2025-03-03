<?php

namespace App\Controllers;

use App\Services\AuthService;
use Exception;

class AuthController
{
    public function login($request)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            http_response_code(400);
            echo json_encode(['message' => 'Username and password are required']);
            exit;
        }

        try {
            $authService = new AuthService();
            $token = $authService->login($username, $password);
            echo json_encode(['token' => $token]);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
