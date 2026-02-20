<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sample CRUD - Formulário</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        .container { max-width: 500px; margin: 50px auto; font-family: sans-serif; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; color: white; background: #3498db; }
        .btn-back { background: #95a5a6; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $user ? 'Editar Registro' : 'Novo Registro' ?></h1>
        
        <form action="<?= BASE_URL ?>sample/save" method="POST">
            <?php if ($user): ?>
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="name" value="<?= $user['name'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>Senha <?= $user ? '<small>(Deixe em branco para manter a atual)</small>' : '' ?></label>
                <input type="password" name="password" <?= $user ? '' : 'required' ?>>
            </div>

            <button type="submit" class="btn">Salvar</button>
            <a href="<?= BASE_URL ?>" class="btn btn-back">Voltar</a>
        </form>
    </div>
</body>
</html>
