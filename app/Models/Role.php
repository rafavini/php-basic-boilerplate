<?php

namespace Models;

use Core\Model;

class Role extends Model
{
    public static function all(): array
    {
        $db   = parent::getDB();
        $stmt = $db->query("SELECT * FROM roles ORDER BY id");
        return $stmt->fetchAll();
    }
}
