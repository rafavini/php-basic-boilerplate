<header>
    <div class="container">
        <h1><a href="/php-basic-boilerplate/dashboard" style="text-decoration: none; color: inherit;">Sistema Didático</a></h1>
        <div class="user-info">
            <?php if (isset($_SESSION['user'])): ?>
                <span>Olá, <strong><?php echo $_SESSION['user']['name']; ?></strong> (<?php echo $_SESSION['user']['role']; ?>)</span>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/php-basic-boilerplate/users" style="color: var(--primary); margin-left: 15px; text-decoration: none; font-weight: bold;">Gerenciar Usuários</a>
                <?php endif; ?>
                <a href="/php-basic-boilerplate/logout" style="margin-left: 15px; color: var(--error); text-decoration: none;">Sair</a>
            <?php endif; ?>
        </div>
    </div>
</header>
