<section style="min-height: 100vh;">
    <p class="fs-4 text-center mt-4">Empresa, este aqui é o seu perfil!</p>
    <div class="d-block p-5 my-4 mx-auto w-75 bg-white center rounded border">
        <?= Sessao::mensagem('empresa') ?>
        <form action="<?= URL ?>/empresas/editar" method="post">
            <p class="fs-6 fw-semibold">Dados da conta:</p>
            <div class="row">
                <div class="col-md-12 mt-3 border-bottom pb-4">
                    <label class="form-label">Email<span class="mx-1 text-danger">*</span></label>
                    <input type="email" class="form-control <?= $dados['email_erro'] ? "is-invalid" : "" ?>" name="email" value="<?= $dados['empresa']->email ?>">
                    <div class="invalid-feedback">
                        <?= $dados['email_erro'] ?>
                    </div>
                </div>
            </div>
            <p class="fs-6 fw-semibold mt-4">Dados da empresa:</p>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">CNPJ<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['cnpj_erro'] ? "is-invalid" : "" ?>" name="cnpj" value="<?= $dados['empresa']->cnpj ?>" readonly>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Nome fantasia<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['nome_erro'] ? "is-invalid" : "" ?>" name="nome" value="<?= $dados['empresa']->nome ?>">
                    <div class="invalid-feedback">
                        <?= $dados['nome_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Endereço<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['endereco_erro'] ? "is-invalid" : "" ?>" name="endereco" value="<?= $dados['empresa']->endereco ?>">
                    <div class="invalid-feedback">
                        <?= $dados['endereco_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Categoria<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['categoria_erro'] ? "is-invalid" : "" ?>" name="categoria" value="<?= $dados['empresa']->categoria ?>">
                    <div class="invalid-feedback">
                        <?= $dados['categoria_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Telefone<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['telefone_erro'] ? "is-invalid" : "" ?>" name="telefone" value="<?= $dados['empresa']->telefone ?>">
                    <div class="invalid-feedback">
                        <?= $dados['telefone_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4 border-bottom pb-4">
                <input type="submit" class="btn btn-dark" value="Editar perfil">
            </div>
        </form>
        <p class="fs-6 fw-semibold mt-4">Dados de segurança:</p>
        <form action="<?= URL ?>/empresas/senha" method="post">
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