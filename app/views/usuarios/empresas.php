<section class="m-4" style="min-height: 100vh;">
    <?php if (isset($dados['empresas'])) : ?>
        <div class="row">
            <div class="col-md-7">
                <p class="fs-5 fw-semibold d-inline-block">Todas as empresas:</p>
            </div>
            <div class="col-md-4">
                <form id="forms" action="<?= URL ?>/usuarios/empresas" method="post">
                    <input class="form-control" type="search" name="pesquisa" placeholder="Empresa..." <?php if (isset($dados['pesquisa'])) : ?>value="<?= $dados['pesquisa'] ?>" <?php endif; ?>>
                </form>
            </div>
            <div class="col-md-1">
                <input type="submit" class="btn btn-dark" value="Pesquisar" form="forms">
            </div>
        </div>
        <?= Sessao::mensagem('pesquisa') ?>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($dados['empresas'] as $empresa) : ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $empresa->nome ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $empresa->categoria ?></h6>
                            <p class="card-text"><i class="bi bi-geo-alt-fill mx-1"></i><?= $empresa->endereco ?><br><i class="bi bi-telephone-fill mx-1"></i><?= $empresa->telefone ?>
                            </p>
                            <a href="<?= URL ?>/usuarios/empresas/<?= $empresa->cnpj ?>" class="card-link">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php elseif (isset($dados['empresa'])) : ?>
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title"><?= $dados['empresa']->nome ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $dados['empresa']->categoria ?></h6>
                <p class="card-text"><i class="bi bi-geo-alt-fill mx-1"></i><?= $dados['empresa']->endereco ?><br><i class="bi bi-telephone-fill mx-1"></i><?= $dados['empresa']->telefone ?><br>
                    <?php if ($dados['empresa']->seguidor == false) : ?>
                        <a type="button" class="btn btn-sm btn-outline-dark mt-3" href="<?= URL ?>/usuarios/seguir/<?= $dados['empresa']->cnpj ?>"><i class="bi bi-person-fill-add mx-1"></i>Seguir</a>
                    <?php else : ?>
                        <a type="button" class="btn btn-sm btn-dark mt-3" href="<?= URL ?>/usuarios/desseguir/<?= $dados['empresa']->cnpj ?>"><i class="bi bi-person-fill-check mx-1"></i>Seguindo</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <?php foreach ($dados['promocoes'] as $promocao) : ?>
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative mt-3">
                <div class="col-md-3 p-3">
                    <img src="<?= $promocao->imagem ?>" class="img-fluid rounded">
                </div>
                <div class="col-md-3 border-end">
                    <div class="col p-4 position-static">
                        <h6 class="m-1">De <strong class="d-inline-block mb-2 text-danger text-decoration-line-through">R$<?= $promocao->preco_inicio ?></strong> por <strong class="d-inline-block mb-2 text-success">R$<?= $promocao->preco_fim ?></strong></h6>
                        <h4 class="m-1"><?= $promocao->titulo ?></h4>
                        <div class="m-1 text-muted"><?= date('d/m/Y', strtotime($promocao->data_inicio)) ?> a <?= date('d/m/Y', strtotime($promocao->data_fim)) ?></div>
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
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php else : ?>
    <?php endif; ?>
</section>