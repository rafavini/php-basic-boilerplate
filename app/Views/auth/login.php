<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <style>
        body{background:#f3f4f6;font-family:sans-serif}
        .box{max-width:420px;margin:80px auto;background:#fff;padding:2rem;border-radius:10px;box-shadow:0 4px 16px rgba(0,0,0,.08)}
        h2{margin-bottom:1.5rem}
        label{display:block;font-weight:600;margin-bottom:.25rem}
        input{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:6px;box-sizing:border-box;margin-bottom:1rem;font-size:1rem}
        button{width:100%;padding:.65rem;background:#4f46e5;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:1rem}
        button:hover{background:#4338ca}
        .err{background:#fee2e2;color:#b91c1c;padding:.75rem;border-radius:6px;margin-bottom:1rem}
        .hint{margin-top:1rem;font-size:.83rem;color:#6b7280;background:#f9fafb;padding:.75rem;border-radius:6px;border:1px solid #e5e7eb}
        code{background:#e5e7eb;padding:.1rem .3rem;border-radius:3px}
    </style>
</head>
<body>
<div class="box">
    <h2>🔐 Login</h2>
    <?php if (!empty($error)): ?>
        <div class="err"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= BASE_URL ?>login">
        <label>E-mail</label>
        <input type="email" name="email" required autofocus>
        <label>Senha</label>
        <input type="password" name="password" required>
        <button>Entrar</button>
    </form>
    <div class="hint">
        <strong>Usuários de teste</strong> — senha: <code>123456</code><br><br>
        <code>admin@teste.com</code> → todas as permissions<br>
        <code>professor@teste.com</code> → sample.* (sem delete) + user.read<br>
        <code>aluno@teste.com</code> → sample.read + user.read
    </div>
</div>
</body>
</html>
