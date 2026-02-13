<?php

namespace Models;

use Core\Database;

class Role
{
    public static function all()
    {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM roles");
        return $stmt->fetchAll();
    }
}
