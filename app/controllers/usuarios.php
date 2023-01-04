<?php

class Usuarios extends Controller
{
    public function __construct()
    {
        $this->usuarioModel = $this->model('Usuario');
        $this->promocaoModel = $this->model('Promocao');
        $this->empresaModel = $this->model('Empresa');
        $this->curtidaModel = $this->model('Curtida');
        $this->denunciaModel = $this->model('Denuncia');
        $this->seguidorModel = $this->model('Seguidor');
    }

    public function promocoes()
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $filtro = filter_input(INPUT_GET, 'filtro');
        $dados = [
            'filtro' => $filtro ? $filtro : 1,
        ];

        $dados += [
            'promocoes' => $this->promocaoModel->promocoesFiltro($dados['filtro'], $_SESSION['usuario_email'])
        ];

        foreach ($dados['promocoes'] as $promocao) {
            $promocao->curtida = $this->curtidaModel->checarCurtida($_SESSION['usuario_email'], $promocao->id);
            $promocao->curtidas = $this->curtidaModel->curtidas($promocao->id);
            $promocao->denuncia = $this->denunciaModel->checarDenuncia($_SESSION['usuario_email'], $promocao->id);
            $promocao->denuncias = $this->denunciaModel->denuncias($promocao->id);
        }

        $this->view('usuarios/promocoes', $dados);
    }

    public function empresas($cnpj = null)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        if ($cnpj == null) :
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($formulario)) :
                $dados = [
                    'pesquisa' => trim($formulario['pesquisa']),
                ];

                $dados += [
                    'empresas' => $this->empresaModel->listarEmpresas($dados['pesquisa']),
                ];

                if ($dados['empresas'] == null) :
                    Sessao::mensagem('pesquisa', null, 'Nenhum resultado encontrado!', null);
                endif;
            else :
                $dados = [
                    'empresas' => $this->empresaModel->listarEmpresas(),
                ];

            endif;
        else :
            $dados = [
                'empresa' => $this->empresaModel->checarEmpresa($cnpj),
                'promocoes' => $this->promocaoModel->promocoesEmpresa($cnpj),
            ];

            $dados['empresa']->seguidor = $this->seguidorModel->checarSeguidor($_SESSION['usuario_email'], $cnpj);

            foreach ($dados['promocoes'] as $promocao) {
                $promocao->curtida = $this->curtidaModel->checarCurtida($_SESSION['usuario_email'], $promocao->id);
                $promocao->curtidas = $this->curtidaModel->curtidas($promocao->id);
                $promocao->denuncia = $this->denunciaModel->checarDenuncia($_SESSION['usuario_email'], $promocao->id);
                $promocao->denuncias = $this->denunciaModel->denuncias($promocao->id);
            }
        endif;

        $this->view('usuarios/empresas', $dados);
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
                'nome' => trim($formulario['nome']),
            ];

            if (empty($formulario['email'])) :
                $dados['email_erro'] = 'Preencha o campo email.';
                $erro++;
            elseif (filter_var($formulario['email'], FILTER_VALIDATE_EMAIL) == false) :
                $dados['email_erro'] = 'Informe um email válido.';
                $erro++;
            endif;

            if (empty($formulario['senha'])) :
                $dados['senha_erro'] = 'Preencha o campo senha.';
                $erro++;
            endif;

            if (empty($formulario['confirma_senha'])) :
                $dados['confirma_senha_erro'] = 'Confirme a sua senha.';
                $erro++;
            elseif (strlen($formulario['senha']) < 8 || strlen($formulario['confirma_senha']) < 8) :
                $dados['senha_erro'] = 'A senha deve ter no mínimo 8 caracteres.';
                $dados['confirma_senha_erro'] = 'A senha deve ter no mínimo 8 caracteres.';
                $erro++;

            elseif ($formulario['senha'] != $formulario['confirma_senha']) :
                $dados['senha_erro'] = 'As senhas informadas são diferentes.';
                $dados['confirma_senha_erro'] = 'As senhas informadas são diferentes.';
                $erro++;
            endif;

            if (empty($formulario['nome'])) :
                $dados['nome_erro'] = 'Preencha o campo nome.';
                $erro++;
            endif;

            if ($erro == 0) :
                $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
                if ($this->usuarioModel->incluir($dados)) :
                    Sessao::mensagem('usuario', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Usuário cadastrado com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $dados = [
                        'email' => '',
                        'senha' => '',
                        'confirma_senha' => '',
                        'nome' => '',
                    ];
                endif;
            endif;

        else :
            $dados = [
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'nome' => '',
            ];
        endif;

        $this->view('usuarios/cadastrar', $dados);
    }

    public function login()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
            ];

            if (empty($formulario['senha'])) :
                $dados['senha_erro'] = 'Preencha o campo senha.';
                $erro++;
            endif;

            if (empty($formulario['email'])) :
                $dados['email_erro'] = 'Preencha o campo email.';
                $erro++;
            elseif (filter_var($formulario['email'], FILTER_VALIDATE_EMAIL) == false) :
                $dados['email_erro'] = 'Informe um email válido.';
                $erro++;
            endif;

            if ($erro == 0) :
                $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);

                if ($usuario) :
                    $this->criarSessaoUsuario($usuario);
                    $dados = [
                        'email' => '',
                        'senha' => '',
                    ];
                    URL::redirecionar('usuarios/promocoes');
                else :
                    Sessao::mensagem('usuario', null, 'Email ou senha inválidos!', null);
                endif;

            endif;

        else :
            $dados = [
                'email' => '',
                'senha' => '',
            ];
        endif;

        $this->view('usuarios/login', $dados);
    }

    private function criarSessaoUsuario($usuario)
    {
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['usuario_nome'] = $usuario->nome;
    }

    public function sair()
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        unset($_SESSION['usuario_email']);
        unset($_SESSION['usuario_nome']);
        session_destroy();
        URL::redirecionar('usuarios/login');
    }

    public function senha()
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'email' => $_SESSION['usuario_email'],
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
            ];

            if (empty($formulario['senha'])) :
                $dados['senha_erro'] = 'Preencha o campo senha.';
                $erro++;
            endif;

            if (empty($formulario['confirma_senha'])) :
                $dados['confirma_senha_erro'] = 'Confirme a sua senha.';
                $erro++;
            elseif (strlen($formulario['senha']) < 8 || strlen($formulario['confirma_senha']) < 8) :
                $dados['senha_erro'] = 'A senha deve ter no mínimo 8 caracteres.';
                $dados['confirma_senha_erro'] = 'A senha deve ter no mínimo 8 caracteres.';
                $erro++;

            elseif ($formulario['senha'] != $formulario['confirma_senha']) :
                $dados['senha_erro'] = 'As senhas informadas são diferentes.';
                $dados['confirma_senha_erro'] = 'As senhas informadas são diferentes.';
                $erro++;
            endif;

            if ($erro == 0) :
                $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
                if ($this->usuarioModel->senha($dados)) :
                    Sessao::mensagem('usuario', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Senha editada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $usuario = $this->usuarioModel->checarUsuario($_SESSION['usuario_email']);
                    $dados = [
                        'usuario' => $usuario
                    ];
                else :
                    Sessao::mensagem('usuario', null, 'Ocorreu um erro ao editar a senha. Tente novamente!', null);
                endif;
            endif;
        endif;

        $usuario = $this->usuarioModel->checarUsuario($_SESSION['usuario_email']);
        $dados = [
            'usuario' => $usuario
        ];

        URL::redirecionar('usuarios/perfil');
    }

    public function perfil()
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $usuario = $this->usuarioModel->checarUsuario($_SESSION['usuario_email']);
        $seguidores = $this->seguidorModel->seguidores($_SESSION['usuario_email']);

        $dados = [
            'usuario' => $usuario,
            'seguidores' => $seguidores
        ];

        $this->view('usuarios/perfil', $dados);
    }

    public function seguir($cnpj)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $seguidor = $this->seguidorModel->checarSeguidor($_SESSION['usuario_email'], $cnpj);

        if ($seguidor == false) :
            $this->seguidorModel->seguir($_SESSION['usuario_email'], $cnpj);
        endif;

        URL::redirecionar('usuarios/perfil');
    }

    public function desseguir($cnpj)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $seguidor = $this->seguidorModel->checarSeguidor($_SESSION['usuario_email'], $cnpj);

        if ($seguidor == true) :
            $this->seguidorModel->desseguir($_SESSION['usuario_email'], $cnpj);
        endif;

        URL::redirecionar('usuarios/perfil');
    }
}
