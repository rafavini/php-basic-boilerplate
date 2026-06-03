<?php

namespace Core;

class Auth
{
    public static function user(): ?array
    {
        return $_SESSION['auth_user'] ?? null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['auth_user']);
    }

    public static function login(array $user): void
    {
        $_SESSION['auth_user'] = $user;
    }

    public static function logout(): void
    {
        unset($_SESSION['auth_user']);
        session_destroy();
    }

    // ──────────────────────────────────────────────────────────────────
    // ✅ Filosofia do vídeo: SEMPRE verificar permission, nunca role
    // ──────────────────────────────────────────────────────────────────

    /**
     * Verifica se o usuário logado possui a permission informada.
     * As permissions já foram carregadas na sessão no momento do login.
     *
     *   if (Auth::can('sample.delete')) { ... }
     */
    public static function can(string $permission): bool
    {
        if (!self::check()) {
            return false;
        }
        $permissions = $_SESSION['auth_user']['permissions'] ?? [];
        return in_array($permission, $permissions, true);
    }

    /**
     * Exige autenticação. Redireciona para /login se não estiver logado.
     */
    public static function require(): void
    {
        if (!self::check()) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    /**
     * Exige uma permission. Redireciona para /403 se não tiver.
     *
     *   Auth::requirePermission('user.delete');
     */
    public static function requirePermission(string $permission): void
    {
        self::require();

        if (!self::can($permission)) {
            header('Location: ' . BASE_URL . '403');
            exit;
        }
    }
}
