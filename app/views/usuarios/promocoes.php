<section style="min-height: 100vh;">
    <div class="row m-3">
        <div class="col-md-7">
            <p class="fs-5 fw-semibold d-inline-block">Todas as promoções:</p>
        </div>
        <div class="col-md-4">
            <form id="forms" action="<?= URL ?>/usuarios/promocoes" method="get">
                <select class="form-select" name="filtro">
                    <option value="1" <?php if ($dados['filtro'] == 1) : ?> selected <?php endif; ?>>Mais recentes</option>
                    <option value="2" <?php if ($dados['filtro'] == 2) : ?> selected <?php endif; ?>>Mais antigas</option>
                </select>
            </form>
        </div>
        <div class="col-md-1">
            <input type="submit" class="btn btn-dark" value="Filtrar" form="forms">
        </div>
    </div>
    <?php foreach ($dados['promocoes'] as $promocao) : ?>
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative m-4">
            <div class="col-md-3 p-3">
                <img src="<?= $promocao->imagem ?>" class="img-fluid rounded">
            </div>
            <div class="col-md-3 border-end">
                <div class="col p-4 position-static">
                    <h6 class="m-1">De <strong class="d-inline-block mb-2 text-danger text-decoration-line-through">R$<?= $promocao->preco_inicio ?></strong> por <strong class="d-inline-block mb-2 text-success">R$<?= $promocao->preco_fim ?></strong></h6>
                    <h4 class="m-1"><?= $promocao->titulo ?></h4>
                    <div class="m-1 text-muted"><?= date('d/m/Y', strtotime($promocao->data_inicio)) ?> a <?= date('d/m/Y', strtotime($promocao->data_fim)) ?></div>
                    <a class="m-1" href="<?= URL ?>/usuarios/empresas/<?= $promocao->cnpj ?>"><?= $promocao->nome ?></a>
                    <div class="btn-group btn-group-sm m-1 mt-3" role="group" aria-label="Small button group">
                        <?php if ($promocao->curtida == false) : ?>
                            <a type="button" class="btn btn-outline-dark" href="<?= URL ?>/promocoes/curtir/<?= $promocao->id ?>"><i class="bi bi-heart-fill mx-1"></i>Curtir</a>
                        <?php else : ?>
                            <a type="button" class="btn btn-dark" href="<?= URL ?>/promocoes/descurtir/<?= $promocao->id ?>"><i class="bi bi-heart-fill mx-1"></i>Curtido</a>
                        <?php endif; ?>
                        <?php if ($promocao->denuncia == false) : ?>
                            <a type="button" class="btn btn-outline-dark" href="<?= URL ?>/promocoes/denunciar/<?= $promocao->id ?>"><i class="bi bi-exclamation-triangle-fill mx-1"></i>Denunciar</a>
                        <?php else : ?>
                            <a type="button" class="btn btn-dark" href="<?= URL ?>/promocoes/inocentar/<?= $promocao->id ?>"><i class="bi bi-exclamation-triangle-fill mx-1"></i>Denunciado</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col p-4 position-static">
                    <p class="fs-6"><span class="fw-semibold">Marca: </span><?= $promocao->marca ?><br>
                        <span class="fw-semibold">Data de validade: </span><?= date('d/m/Y', strtotime($promocao->validade)) ?><br>
                        <span class="fw-semibold">Descrição: </span><?= $promocao->descricao ?><br>
                        <div class="m-1 text-muted"><?= $promocao->curtidas ?> curtidas / <?= $promocao->denuncias ?> denúncias</div>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</section>