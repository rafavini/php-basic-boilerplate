<?php

namespace Models;

use Core\Model;
use PDO;

class Sample extends Model
{
    /**
     * Get all users from the sample table
     */
    public static function all()
    {
        $db = parent::getDB();
        $stmt = $db->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    /**
     * Find a single user by ID
     */
    public static function find($id)
    {
        $db = parent::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Create a new user record
     */
    public static function create($data)
    {
        $db = parent::getDB();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Update an existing user record
     */
    public static function update($id, $data)
    {
        $db = parent::getDB();
        $sql = "UPDATE users SET name = :name, email = :email";
        $params = [
            'id'    => $id,
            'name'  => $data['name'],
            'email' => $data['email']
        ];

        if (!empty($data['password'])) {
            $sql .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = :id";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Delete a user record
     */
    public static function delete($id)
    {
        $db = parent::getDB();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
