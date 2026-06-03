<?php

namespace Models;

use Core\Model;

class User extends Model
{
    /**
     * Busca usuário por e-mail e já carrega todas as permissions via JOIN.
     * Retorna array com chave 'permissions' => ['user.read', 'sample.create', ...]
     */
    public static function findByEmailWithPermissions(string $email): ?array
    {
        $db = parent::getDB();

        // 1. Dados básicos do usuário
        $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user) return null;

        // 2. Roles do usuário
        $stmt = $db->prepare("
            SELECT r.name
            FROM roles r
            INNER JOIN role_user ru ON ru.role_id = r.id
            WHERE ru.user_id = :uid
        ");
        $stmt->execute(['uid' => $user['id']]);
        $user['roles'] = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        // 3. Todas as permissions (via roles → permission_role)
        $stmt = $db->prepare("
            SELECT DISTINCT p.name
            FROM permissions p
            INNER JOIN permission_role pr ON pr.permission_id = p.id
            INNER JOIN role_user ru        ON ru.role_id       = pr.role_id
            WHERE ru.user_id = :uid
        ");
        $stmt->execute(['uid' => $user['id']]);
        $user['permissions'] = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        return $user;
    }

    public static function all(): array
    {
        $db   = parent::getDB();
        $stmt = $db->query("
            SELECT u.id, u.name, u.email,
                   GROUP_CONCAT(r.name ORDER BY r.name SEPARATOR ', ') AS roles
            FROM users u
            LEFT JOIN role_user ru ON ru.user_id = u.id
            LEFT JOIN roles r      ON r.id = ru.role_id
            GROUP BY u.id
            ORDER BY u.id DESC
        ");
        return $stmt->fetchAll();
    }

    public static function find($id): ?array
    {
        $db   = parent::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function rolesOf(int $userId): array
    {
        $db   = parent::getDB();
        $stmt = $db->prepare("SELECT role_id FROM role_user WHERE user_id = :uid");
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function create(array $data): bool
    {
        $db = parent::getDB();
        $db->beginTransaction();

        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $userId = $db->lastInsertId();

        self::syncRoles($db, $userId, $data['role_ids'] ?? []);

        $db->commit();
        return true;
    }

    public static function update(int $id, array $data): bool
    {
        $db  = parent::getDB();
        $db->beginTransaction();

        $sql    = "UPDATE users SET name = :name, email = :email";
        $params = ['id' => $id, 'name' => $data['name'], 'email' => $data['email']];

        if (!empty($data['password'])) {
            $sql .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $db->prepare($sql . " WHERE id = :id")->execute($params);

        self::syncRoles($db, $id, $data['role_ids'] ?? []);

        $db->commit();
        return true;
    }

    public static function delete(int $id): bool
    {
        $db   = parent::getDB();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // ── helper: sincroniza roles do usuário ──────────────────────────
    private static function syncRoles($db, int $userId, array $roleIds): void
    {
        $db->prepare("DELETE FROM role_user WHERE user_id = :uid")->execute(['uid' => $userId]);
        if (empty($roleIds)) return;
        $stmt = $db->prepare("INSERT INTO role_user (user_id, role_id) VALUES (:uid, :rid)");
        foreach ($roleIds as $roleId) {
            $stmt->execute(['uid' => $userId, 'rid' => $roleId]);
        }
    }
}
