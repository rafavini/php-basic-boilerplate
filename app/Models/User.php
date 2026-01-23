<?php

namespace Models;

use Core\Database;
use PDO;

class User
{
    public static function findByEmail($email)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public static function all()
    {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id");
        return $stmt->fetchAll();
    }
}
