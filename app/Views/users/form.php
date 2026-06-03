<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title><?= $user ? 'Editar' : 'Novo' ?> Usuário</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        body{font-family:sans-serif;padding:2rem}
        form{max-width:480px}
        label{display:block;font-weight:600;margin-top:1rem}
        input{width:100%;padding:.5rem;border:1px solid #d1d5db;border-radius:4px;box-sizing:border-box;margin-top:.25rem}
        .role-list{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.5rem}
        .role-list label{background:#f3f4f6;border:1px solid #e5e7eb;padding:.35rem .75rem;border-radius:6px;font-weight:normal;cursor:pointer}
        button{margin-top:1.5rem;padding:.6rem 1.5rem;background:#4f46e5;color:#fff;border:none;border-radius:6px;cursor:pointer}
        nav a{color:#4f46e5;text-decoration:none}
    </style>
</head>
<body>
    <h1><?= $user ? 'Editar' : 'Novo' ?> Usuário</h1>
    <nav><a href="<?= BASE_URL ?>users">← Voltar</a></nav>

    <form method="POST" action="<?= BASE_URL ?>users/save">
        <?php if ($user): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <?php endif; ?>

        <label>Nome</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>

        <label>E-mail</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>

        <label>Senha <?= $user ? '(deixe em branco para manter)' : '' ?></label>
        <input type="password" name="password" <?= $user ? '' : 'required' ?>>

        <label>Roles</label>
        <div class="role-list">
            <?php foreach ($roles as $role): ?>
                <label>
                    <input type="checkbox" name="role_ids[]" value="<?= $role['id'] ?>"
                        <?= in_array($role['id'], $userRoleIds) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($role['name']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
