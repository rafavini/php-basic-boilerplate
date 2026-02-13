<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <!-- Simple CSS for Table -->
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 4px; }
        .btn-primary { background-color: #007bff; }
        .btn-danger { background-color: #dc3545; }
        .btn-success { background-color: #28a745; }
    </style>
</head>
<body>

    <h2>Gerenciar Usuários</h2>
    
    <a href="/php-basic-boilerplate/users/form" class="btn btn-success">Novo Usuário</a>
    <a href="/php-basic-boilerplate/dashboard" class="btn btn-secondary" style="background-color: #6c757d;">Voltar</a>

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

</body>
</html>
