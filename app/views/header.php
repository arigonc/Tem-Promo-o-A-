<?php if (!isset($_SESSION['usuario_email']) && !isset($_SESSION['empresa_cnpj'])) : ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL ?>">Tem Promoção Aí?</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>">Início</a>
                    <a class="nav-link" href="<?= URL ?>/usuarios/login">Sou usuário</a>
                    <a class="nav-link" href="<?= URL ?>/empresas/login">Sou empresa</a>
                </div>
            </div>
        </div>
    </nav>
<?php elseif (isset($_SESSION['empresa_cnpj'])) : ?>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL ?>">Tem Promoção Aí?</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Tem Promoção Aí?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <span class="border border-light border-opacity-25"></span>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <p class="mt-4 fs-6 fw-semibold">Olá, <?= $_SESSION['empresa_nome'] ?></p>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/empresas/dashboard">Meu dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/empresas/perfil">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/empresas/sair">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php elseif (isset($_SESSION['usuario_email'])) : ?>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL ?>">Tem Promoção Aí?</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Tem Promoção Aí?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <span class="border border-light border-opacity-25"></span>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <p class="mt-4 fs-6 fw-semibold">Olá, <?= $_SESSION['usuario_nome'] ?></p>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/usuarios/promocoes">Promoções</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/usuarios/empresas">Empresas</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/usuarios/perfil">Meu perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-3 nav-link" aria-current="page" href="<?= URL ?>/usuarios/sair">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?>