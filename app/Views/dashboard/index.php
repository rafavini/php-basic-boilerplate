<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PHP MVC</title>
    <link rel="stylesheet" href="/php-basic-boilerplate/public/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Sistema Didático</h1>
            <div class="user-info">
                Olá, <strong><?php echo $user['name']; ?></strong> (<?php echo $user['role']; ?>)
                <a href="/php-basic-boilerplate/logout" class="logout-link">Sair</a>
            </div>
        </div>
    </header>

    <main class="container">
        <section class="card">
            <h2>Lista de Usuários (Renderizado via PHP)</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo $u['name']; ?></td>
                            <td><?php echo $u['email']; ?></td>
                            <td><span class="badge <?php echo $u['role_name']; ?>"><?php echo $u['role_name']; ?></span></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>

        <section class="card">
            <h2>Ação Dinâmica (Fetch API)</h2>
            <p>Ao clicar no botão abaixo, os dados sero recarregados via JSON pela API interna.</p>
            <button id="btnLoadApi" class="btn secondary">Recarregar via AJAX</button>
            <div id="apiResponse" class="api-console">
                <p>Clique para ver a mágica do JS + PHP API...</p>
            </div>
        </section>
    </main>

    <script src="/php-basic-boilerplate/public/js/app.js"></script>
</body>
</html>
