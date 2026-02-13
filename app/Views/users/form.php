<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($user) ? 'Editar' : 'Novo' ?> Usuário</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        .btn { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; margin-top: 20px; }
        .btn-back { background-color: #6c757d; text-decoration: none; display: inline-block; text-align: center; }
    </style>
</head>
<body>

    <h2><?= isset($user) ? 'Editar' : 'Criar' ?> Usuário</h2>

    <form action="/php-basic-boilerplate/users/<?= isset($user) ? 'update' : 'store' ?>" method="POST">
        
        <?php if (isset($user)): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <?php endif; ?>

        <label>Nome:</label>
        <input type="text" name="name" value="<?= $user['name'] ?? '' ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" required>

        <label>Senha: <?= isset($user) ? '<small>(Deixe em branco para manter a atual)</small>' : '' ?></label>
        <input type="password" name="password" <?= isset($user) ? '' : 'required' ?>>

        <label>Função:</label>
        <select name="role_id" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['id'] ?>" <?= (isset($user) && $user['role_id'] == $role['id']) ? 'selected' : '' ?>>
                    <?= $role['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn">Salvar</button>
        <a href="/php-basic-boilerplate/users" class="btn btn-back">Cancelar</a>
    </form>

</body>
</html>
