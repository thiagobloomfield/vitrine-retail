<?php

namespace App\Middlewares;

use App\Services\AuthService;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Authorization header missing']);
            exit;
        }

        $authService = new AuthService();
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $authService->validateToken($token);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid token']);
            exit;
        }

        return $next($request);
    }
}
