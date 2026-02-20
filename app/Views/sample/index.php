<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sample CRUD - Listagem</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        .container { max-width: 800px; margin: 50px auto; font-family: sans-serif; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; color: white; background: #3498db; }
        .btn-danger { background: #e74c3c; }
        .btn-success { background: #2ecc71; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions { display: flex; gap: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Exemplo Didático de CRUD</h1>
        <p>Este é um fluxo simples: Model -> Controller -> View</p>
        
        <a href="<?= BASE_URL ?>sample/form" class="btn btn-success">Novo Registro</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['name'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td class="actions">
                            <a href="<?= BASE_URL ?>sample/form?id=<?= $u['id'] ?>">Editar</a>
                            <a href="<?= BASE_URL ?>sample/delete?id=<?= $u['id'] ?>" class="text-danger" style="color:red;" onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
