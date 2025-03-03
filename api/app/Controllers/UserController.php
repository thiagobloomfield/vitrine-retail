<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        try {
            echo json_encode($this->userService->getAll());
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal error', 'error' => $th]);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userService->findById($id);
            if ($user) {
                echo json_encode($user);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'User not found']);
            }
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal error', 'error' => $th]);
        }
    }

    public function store()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userCreateResut = $this->userService->create($data);

            if ($userCreateResut === 400) {
                http_response_code(400);
                echo json_encode(['message' => 'Missing required fields']);
                exit;
            }

            echo json_encode(['message' => 'User created']);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal error', 'error' => $th]);
        }
    }

    public function update($id)
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $userResut = $this->userService->update($id, $data);

            if ($userResut === 400) {
                http_response_code(400);
                echo json_encode(['message' => 'Missing required fields']);
                exit;
            }

            echo json_encode(['message' => 'User updated']);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal error', 'error' => $th]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            echo json_encode(['message' => 'User deleted']);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal error', 'error' => $th]);
        }
    }
}
