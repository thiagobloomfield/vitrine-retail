<?php

namespace App\Repositories;

use App\Database;
use PDO;

class ProfileRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function findByName($name)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM profiles WHERE name = :name LIMIT 1');
        $stmt->execute(['name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM profiles');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM profiles WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name)
    {
        $stmt = $this->pdo->prepare('INSERT INTO profiles (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);
    }

    public function update($id, $name)
    {
        $stmt = $this->pdo->prepare('UPDATE profiles SET name = :name WHERE id = :id');
        $stmt->execute(['name' => $name, 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM profiles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
