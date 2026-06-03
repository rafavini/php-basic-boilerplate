<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        body{font-family:sans-serif;padding:2rem;background:#f9fafb}
        .badge{display:inline-block;padding:.2rem .65rem;border-radius:99px;font-size:.75rem;font-weight:700;background:#e0e7ff;color:#3730a3;margin:.15rem}
        nav a{margin-right:1rem;color:#4f46e5;text-decoration:none}
        .card{background:#fff;padding:1.5rem;border-radius:8px;margin-top:1.5rem;border:1px solid #e5e7eb}
        .perm{display:inline-block;padding:.15rem .55rem;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:4px;font-size:.8rem;font-family:monospace;margin:.15rem}
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Olá, <strong><?= htmlspecialchars($user['name']) ?></strong>!</p>

    <p>
        Roles:
        <?php foreach ($user['roles'] as $r): ?>
            <span class="badge"><?= htmlspecialchars($r) ?></span>
        <?php endforeach; ?>
    </p>

    <nav>
        <?php if (in_array('sample.read', $user['permissions'])): ?>
            <a href="<?= BASE_URL ?>">📋 Sample CRUD</a>
        <?php endif; ?>
        <?php if (in_array('user.read', $user['permissions'])): ?>
            <a href="<?= BASE_URL ?>users">👥 Usuários</a>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>logout">🚪 Sair</a>
    </nav>

    <div class="card">
        <strong>Suas permissions:</strong><br><br>
        <?php foreach ($user['permissions'] as $p): ?>
            <span class="perm"><?= htmlspecialchars($p) ?></span>
        <?php endforeach; ?>
    </div>
</body>
</html>
