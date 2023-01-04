<section style="min-height: 100vh;">
    <nav class="w-75 mx-auto my-4 p-2 pt-3 px-4 bg-light rounded border">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/empresas/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver</li>
        </ol>
    </nav>
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative w-75 mx-auto">
        <div class="col-md-4 p-3">
            <img src="<?= $dados['promocao']->imagem ?>" class="img-fluid rounded">
        </div>
        <div class="col-md-8">
            <div class="col p-4 position-static">
                <h6 class="m-1">De <strong class="d-inline-block mb-2 text-danger text-decoration-line-through">R$<?= $dados['promocao']->preco_inicio ?></strong> por <strong class="d-inline-block mb-2 text-success">R$<?= $dados['promocao']->preco_fim ?></strong></h6>
                <h4 class="m-1"><?= $dados['promocao']->titulo ?></h4>
                <div class="m-1 text-muted"><?= date('d/m/Y', strtotime($dados['promocao']->data_inicio)) ?> a <?= date('d/m/Y', strtotime($dados['promocao']->data_fim)) ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col p-4 position-static">
                <p class="fs-6"><span class="fw-semibold">Marca: </span><?= $dados['promocao']->marca ?><br>
                    <span class="fw-semibold">Data de validade: </span><?= date('d/m/Y', strtotime($dados['promocao']->validade)) ?><br>
                    <span class="fw-semibold">Descrição: </span><?= $dados['promocao']->descricao ?><br>
                </p>
            </div>
        </div>
    </div>
</section>