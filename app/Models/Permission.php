<?php

namespace Models;

use Core\Model;

class Permission extends Model
{
    public static function all(): array
    {
        $db   = parent::getDB();
        $stmt = $db->query("SELECT * FROM permissions ORDER BY name");
        return $stmt->fetchAll();
    }

    public static function ofRole(int $roleId): array
    {
        $db   = parent::getDB();
        $stmt = $db->prepare("
            SELECT permission_id FROM permission_role WHERE role_id = :rid
        ");
        $stmt->execute(['rid' => $roleId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}
