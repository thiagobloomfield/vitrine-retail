<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAll() {
        return $this->userRepository->getAll();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create($data)
    {
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $profile_id = $data['profile_id'] ?? null;

        if (!$username || !$password || !$profile_id) {
            return 400;
        }

        $this->userRepository->create($username, password_hash($password, PASSWORD_DEFAULT), $profile_id);
        return 201;
    }

    public function update($id, $data)
    {
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $profile_id = $data['profile_id'] ?? null;

        if (!$username || !$password || !$profile_id) {
            return 400;
        }

        $this->userRepository->update($id, $username, password_hash($password, PASSWORD_DEFAULT), $profile_id);
        return 200;
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
