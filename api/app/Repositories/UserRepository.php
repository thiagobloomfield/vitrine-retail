<?php

namespace App\Repositories;

use App\Database;
use PDO;

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $password, $profile_id)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password, profile_id) VALUES (:username, :password, :profile_id)');
        $stmt->execute(['username' => $username, 'password' => $password, 'profile_id' => $profile_id]);
    }

    public function update($id, $username, $password, $profile_id)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET username = :username, password = :password, profile_id = :profile_id WHERE id = :id');
        $stmt->execute(['username' => $username, 'password' => $password, 'profile_id' => $profile_id, 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
