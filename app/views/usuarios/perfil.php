<section class="m-4" style="min-height: 100vh;">
    <p class="fs-4 text-center mt-4"><?= $dados['usuario']->nome ?>, este aqui é o seu perfil!</p>
    <p class="fs-5 fw-semibold mt-4">Seguindo:</p>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($dados['seguidores'] == null) : ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum seguindo encontrado!</td>
                    </tr>
                <?php endif ?>
                <?php foreach ($dados['seguidores'] as $seguidor) : ?>
                    <tr>
                        <th scope="row"><?= $seguidor->nome ?></th>
                        <td><?= $seguidor->categoria ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-success" href="<?= URL ?>/usuarios/empresas/<?= $seguidor->cnpj ?>" class="m-1"><i class="bi bi-eye-fill"></i></a>
                            <a type="button" class="btn btn-outline-danger" href="<?= URL ?>/usuarios/desseguir/<?= $seguidor->cnpj ?>" class="m-1"><i class="bi bi-person-fill-dash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <p class="fs-5 fw-semibold mt-4">Editar dados:</p>
    <div class="d-block p-5 my-4 mx-auto w-75 bg-white center rounded border">
        <?= Sessao::mensagem('usuario') ?>
        <p class="fs-6 fw-semibold">Dados da conta:</p>
        <div class="row border-bottom pb-4">
            <div class="col-md-6 mt-3">
                <label class="form-label">Email<span class="mx-1 text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="<?= $dados['usuario']->email ?>" readonly>
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label">Nome<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control" name="nome" value="<?= $dados['usuario']->nome ?>" readonly>
            </div>
        </div>
        <p class="fs-6 fw-semibold mt-4">Dados de segurança:</p>
        <form action="<?= URL ?>/usuarios/senha" method="post">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Senha<span class="mx-1 text-danger">*</span></label> <input type="password" class="form-control <?= $dados['senha_erro'] ? "is-invalid" : "" ?>" name="senha">
                    <div class="invalid-feedback">
                        <?= $dados['senha_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Confirme a senha<span class="mx-1 text-danger">*</span></label> <input type="password" class="form-control <?= $dados['confirma_senha_erro'] ? "is-invalid" : "" ?>" name="confirma_senha">
                    <div class="invalid-feedback">
                        <?= $dados['confirma_senha_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <input type="submit" class="btn btn-dark" value="Editar senha">
            </div>
        </form>
    </div>
</section>