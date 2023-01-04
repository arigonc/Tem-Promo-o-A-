<section style="min-height: 100vh;">
    <div class="container col-xl-10 col-xxl-8 px-4">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <div style="font-size: 36px;">Tem Promoção Aí?</div>
                <div class="fs-5 w-75">O brasileiro gosta de uma promoção... e nós também! Procure novos produtos que estão em promoção nas suas empresas favoritas!</div>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <div class="card border-0 shadow rounded-3 my-3">
                    <div class="card-body p-4 p-sm-5 p-3">
                        <h4 class="card-title text-center mb-4 fs-5">Login</h4>
                        <form action="<?= URL ?>/usuarios/login" method="post">
                            <div class="form-floating mb-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control <?= $dados['email_erro'] ? "is-invalid" : "" ?>" name="email" placeholder="Email..." value="<?= $dados['email'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $dados['email_erro'] ?>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control  <?= $dados['senha_erro'] ? "is-invalid" : "" ?>" name="senha" placeholder="Senha..." value="<?= $dados['senha'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $dados['senha_erro'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check p-1">
                                <a href="<?= URL ?>/usuarios/recuperar_senha">Esqueci minha senha</a>
                            </div>
                            <div class="form-check p-1 mb-2">
                                <a href="<?= URL ?>/usuarios/cadastrar">Ainda não sou
                                    cadastrado</a>
                            </div>
                            <?= Sessao::mensagem('usuario') ?>
                            <div class="d-grid">
                                <div class="btn-cadastrar-form">
                                    <input type="submit" class="btn btn-dark" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>