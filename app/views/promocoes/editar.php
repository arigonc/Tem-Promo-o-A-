<section style="min-height: 100vh;">
    <nav class="w-75 mx-auto my-4 p-2 pt-3 px-4 bg-light rounded border">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/empresas/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
    <div class="d-block p-5 my-4 mx-auto w-75 bg-white center rounded border">
        <?= Sessao::mensagem('promocao') ?>
        <form action="<?= URL ?>/promocoes/editar/<?= $dados['promocao']->id ?>" method="post">
            <p class="fs-6 fw-semibold">Dados do produto:</p>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Título<span class="mx-1 text-danger">*</span></label>
                    <input type="text" class="form-control <?= $dados['titulo_erro'] ? "is-invalid" : "" ?>" name="titulo" value="<?= $dados['promocao']->titulo ?>">
                    <div class="invalid-feedback">
                        <?= $dados['titulo_erro'] ?>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <label class="form-label">Marca<span class="mx-1 text-danger">*</span></label>
                    <input type="text" class="form-control <?= $dados['marca_erro'] ? "is-invalid" : "" ?>" name="marca" value="<?= $dados['promocao']->marca ?>">
                    <div class="invalid-feedback">
                        <?= $dados['marca_erro'] ?>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <label class="form-label">Data de validade<span class="mx-1 text-danger">*</span></label>
                    <input type="date" class="form-control <?= $dados['validade_erro'] ? "is-invalid" : "" ?>" name="validade" value="<?= $dados['promocao']->validade ?>">
                    <div class="invalid-feedback">
                        <?= $dados['validade_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Descrição<span class="mx-1 text-danger">*</span></label>
                    <textarea class="form-control <?= $dados['descricao_erro'] ? "is-invalid" : "" ?>" rows="5" name="descricao"><?= $dados['promocao']->descricao ?></textarea>
                    <div class="invalid-feedback">
                        <?= $dados['descricao_erro'] ?>
                    </div>
                </div>
            </div>
            <p class="fs-6 fw-semibold mt-4">Dados da promoção:</p>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Data de início<span class="mx-1 text-danger">*</span></label>
                    <input type="date" class="form-control <?= $dados['data_inicio_erro'] ? "is-invalid" : "" ?>" name="data_inicio" value="<?= $dados['promocao']->data_inicio ?>">
                    <div class="invalid-feedback">
                        <?= $dados['data_inicio_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Data de encerramento<span class="mx-1 text-danger">*</span></label>
                    <input type="date" class="form-control <?= $dados['data_fim_erro'] ? "is-invalid" : "" ?>" name="data_fim" value="<?= $dados['promocao']->data_fim ?>">
                    <div class="invalid-feedback">
                        <?= $dados['data_fim_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Imagem<span class="mx-1 text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">URL</span>
                        <input type="text" class="form-control <?= $dados['imagem_erro'] ? "is-invalid" : "" ?>" name="imagem" value="<?= $dados['promocao']->imagem ?>">
                    </div>
                    <div class="invalid-feedback">
                        <?= $dados['imagem_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Preço antes da promoção<span class="mx-1 text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">R$</span>
                        <input type="text" class="form-control <?= $dados['preco_inicio_erro'] ? "is-invalid" : "" ?>" name="preco_inicio" value="<?= $dados['promocao']->preco_inicio ?>">
                    </div>
                    <div class="invalid-feedback">
                        <?= $dados['preco_inicio_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Preço na promoção<span class="mx-1 text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">R$</span>
                        <input type="text" class="form-control <?= $dados['preco_fim_erro'] ? "is-invalid" : "" ?>" name="preco_fim" value="<?= $dados['promocao']->preco_fim ?>">
                        <div class="invalid-feedback">
                            <?= $dados['preco_fim_erro'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 mx-auto mt-3">
                    <img src="<?= $dados['promocao']->imagem ?>" class="img-fluid rounded">
                    <figcaption class="figure-caption text-end">Imagem cadastrada anteriormente.</figcaption>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="form-check">
                    <small class="text-muted">Ao editar, você concorda com
                        os termos de uso e a política de privacidade.</small>
                </div>
            </div>
            <div class="col-12 mt-4">
                <input type="submit" class="btn btn-dark" value="Salvar">
            </div>
        </form>
    </div>
</section>