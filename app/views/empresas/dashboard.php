<section class="m-4" style="min-height: 100vh;">
    <?= Sessao::mensagem('promocao') ?>
    <p class="fs-5 fw-semibold">Dashboard:</p>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body d-flex">
                    <h1 class="m-3"><i class="bi bi-bar-chart-line-fill"></i></h1>
                    <p class="card-text text-end"><b><?= $dados['num_promocoes'] ?></b> promoções totais cadastradas pela empresa.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-warning text-white mb-3" style="max-width: 18rem;">
                <div class="card-body d-flex">
                    <h1 class="m-3"><i class="bi bi-pie-chart-fill"></i></i></h1>
                    <p class="card-text text-end"><b><?= $dados['num_ativos'] ?></b> promoções estão ativas, ou seja, dentro do período de vigência.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body d-flex">
                    <h1 class="m-3"><i class="bi bi-people-fill"></i></h1>
                    <p class="card-text text-end"><b><?= $dados['num_seguidores'] ?></b> pessoas acompanham a sua empresa e as suas promoções.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body d-flex">
                    <h1 class="m-3"><i class="bi bi-heart-fill"></i></h1>
                    <p class="card-text text-end"><b><?= $dados['num_curtidas'] ?></b> curtidas pelas pessoas em todas as suas promoções.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="my-5 mb-3">
        <p class="fs-5 fw-semibold d-inline-block">Todas as suas promoções:</p>
        <a class="btn btn-primary btn-sm d-inline-block float-end" type="button" href="<?= URL ?>/promocoes/cadastrar"><i class="bi bi-plus-circle-fill mx-1"></i>Cadastrar nova promoção</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Preço inicial</th>
                    <th scope="col">Preço final</th>
                    <th scope="col">Início</th>
                    <th scope="col">Término</th>
                    <th scope="col">Curtidas</th>
                    <th scope="col">Denúncias</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($dados['promocoes'] == null) : ?>
                    <tr>
                        <td colspan="9" class="text-center">Nenhuma promoção cadastrada!</td>
                    </tr>
                <?php endif ?>
                <?php foreach ($dados['promocoes'] as $promocao) : ?>
                    <tr>
                        <th scope="row"><?= $promocao->titulo ?></th>
                        <td>R$<?= $promocao->preco_inicio ?></td>
                        <td>R$<?= $promocao->preco_fim ?></td>
                        <td><?= date('d/m/Y', strtotime($promocao->data_inicio)) ?></td>
                        <td><?= date('d/m/Y', strtotime($promocao->data_fim)) ?></td>
                        <td><?= $promocao->curtidas ?></td>
                        <td><?= $promocao->denuncias ?></td>
                        <td><?php if (date('d/m/y') >= date('d/m/Y', strtotime($promocao->data_inicio)) && date('d/m/y') <= date('d/m/Y', strtotime($promocao->data_fim))) : ?>
                                <span class="badge text-bg-success">Ativo</span><?php else : ?><span class="badge text-bg-danger">Inativo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a type="button" class="btn btn-outline-success" href="<?= URL ?>/promocoes/ver/<?= $promocao->id ?>" class="m-1"><i class="bi bi-eye-fill"></i></a>
                            <a type="button" class="btn btn-outline-dark" href="<?= URL ?>/promocoes/editar/<?= $promocao->id ?>" class="m-1"><i class="bi bi-pencil-fill"></i></a>
                            <a type="button" class="btn btn-outline-danger" href="<?= URL ?>/promocoes/remover/<?= $promocao->id ?>" class="m-1"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>