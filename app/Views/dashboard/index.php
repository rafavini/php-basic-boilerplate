<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PHP MVC</title>
    <link rel="stylesheet" href="/php-basic-boilerplate/public/css/style.css">
</head>
<body>
    <?php require __DIR__ . '/../components/navbar.php'; ?>

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
