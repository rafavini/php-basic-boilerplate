<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - PHP MVC</title>
    <link rel="stylesheet" href="/php-basic-boilerplate/public/css/style.css">
</head>
<body class="auth-page">
    <div class="login-container">
        <h1>Didactic PHP MVC</h1>
        <p>Acesse o sistema</p>
        
        <?php if (isset($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="/php-basic-boilerplate/login" method="POST">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" required placeholder="admin@teste.com">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" required placeholder="123456">
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <div class="footer-info">
            <p>Admin: admin@teste.com / 123456</p>
            <p>Roles: admin, professor, aluno</p>
        </div>
    </div>
</body>
</html>
