<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="/php-basic-boilerplate/public/css/style.css">
</head>
<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>

    <div class="container">
        <h2>Gerenciar Usuários</h2>
        
        <a href="/php-basic-boilerplate/users/form" class="btn" style="background-color: var(--success); width: auto; display: inline-block; text-decoration: none; color: white; padding: 10px 15px; border-radius: 6px;">Novo Usuário</a>
        <a href="/php-basic-boilerplate/dashboard" class="btn" style="background-color: var(--gray); width: auto; display: inline-block; text-decoration: none; color: white; padding: 10px 15px; border-radius: 6px;">Voltar</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Role</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role_name'] ?></td>
                <td>
                    <a href="/php-basic-boilerplate/users/form?id=<?= $user['id'] ?>" class="btn btn-primary">Editar</a>
                    <a href="/php-basic-boilerplate/users/delete?id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>">Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>">Próximo</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    </div>

</body>
</html>
