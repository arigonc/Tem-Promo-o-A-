<section style="min-height: 100vh;">
    <p class="fs-4 text-center mt-4">Usuário, cadastre-se abaixo!</p>
    <div class="d-block p-5 my-4 mx-auto w-75 bg-white center rounded border">
        <?= Sessao::mensagem('usuario') ?>
        <form action="<?= URL ?>/usuarios/cadastrar" method="post" autocomplete="off">
            <p class="fs-6 fw-semibold">Dados da conta:</p>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Email<span class="mx-1 text-danger">*</span></label>
                    <input type="email" class="form-control <?= $dados['email_erro'] ? "is-invalid" : "" ?>" name="email" value="<?= $dados['email'] ?>">
                    <div class="invalid-feedback">
                        <?= $dados['email_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Nome<span class="mx-1 text-danger">*</span></label> <input type="text" class="form-control <?= $dados['nome_erro'] ? "is-invalid" : "" ?>" name="nome" value="<?= $dados['nome'] ?>">
                    <div class="invalid-feedback">
                        <?= $dados['nome_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="form-label">Senha<span class="mx-1 text-danger">*</span></label> <input type="password" class="form-control <?= $dados['senha_erro'] ? "is-invalid" : "" ?>" name="senha" value="<?= $dados['senha'] ?>">
                    <div class="invalid-feedback">
                        <?= $dados['senha_erro'] ?>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label class="form-label">Confirme a senha<span class="mx-1 text-danger">*</span></label> <input type="password" class="form-control <?= $dados['confirma_senha_erro'] ? "is-invalid" : "" ?>" name="confirma_senha" value="<?= $dados['confirma_senha'] ?>">
                    <div class="invalid-feedback">
                        <?= $dados['confirma_senha_erro'] ?>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="form-check">
                    <small class="text-muted">Ao cadastrar, você concorda com
                        os termos de uso e a política de privacidade.</small>
                </div>
            </div>
            <div class="col-12 mt-4">
                <input type="submit" class="btn btn-dark" value="Cadastrar">
            </div>
        </form>
    </div>
</section>