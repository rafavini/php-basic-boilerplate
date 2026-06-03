<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Usuários</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        body{font-family:sans-serif;padding:2rem}
        table{width:100%;border-collapse:collapse}
        th,td{text-align:left;padding:.6rem .8rem;border-bottom:1px solid #e5e7eb}
        th{background:#f3f4f6}
        nav a,td a{color:#4f46e5;text-decoration:none;margin-right:.5rem}
    </style>
</head>
<body>
    <h1>👥 Usuários</h1>
    <nav>
        <?php if (\Core\Auth::can('user.create')): ?>
            <a href="<?= BASE_URL ?>users/form">➕ Novo</a>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>dashboard">← Dashboard</a>
    </nav><br>
    <table>
        <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Roles</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['roles'] ?? '—') ?></td>
                <td>
                    <?php if (\Core\Auth::can('user.update')): ?>
                        <a href="<?= BASE_URL ?>users/form?id=<?= $u['id'] ?>">Editar</a>
                    <?php endif; ?>
                    <?php if (\Core\Auth::can('user.delete')): ?>
                        <a href="<?= BASE_URL ?>users/delete?id=<?= $u['id'] ?>"
                           onclick="return confirm('Deletar?')">Deletar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
