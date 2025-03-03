<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        $stmt = $this->userRepository->getAll();
        echo json_encode($stmt);
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'User not found']);
        }
    }

    public function store()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $profile_id = $data['profile_id'] ?? null;

        if (!$username || !$password || !$profile_id) {
            http_response_code(400);
            echo json_encode(['message' => 'Missing required fields']);
            exit;
        }

        $this->userRepository->create($username, password_hash($password, PASSWORD_DEFAULT), $profile_id);
        echo json_encode(['message' => 'User created']);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $profile_id = $data['profile_id'] ?? null;

        if (!$username || !$password || !$profile_id) {
            http_response_code(400);
            echo json_encode(['message' => 'Missing required fields']);
            exit;
        }

        $this->userRepository->update($id, $username, password_hash($password, PASSWORD_DEFAULT), $profile_id);
        echo json_encode(['message' => 'User updated']);
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        echo json_encode(['message' => 'User deleted']);
    }
}
