<?php

class Empresas extends Controller
{
    public function __construct()
    {
        $this->empresaModel = $this->model('Empresa');
        $this->promocaoModel = $this->model('Promocao');
        $this->curtidaModel = $this->model('Curtida');
        $this->denunciaModel = $this->model('Denuncia');
        $this->seguidorModel = $this->model('Seguidor');
    }

    public function dashboard()
    {
        $ativos = 0;
        $dados = [
            'promocoes' => $this->promocaoModel->promocoesEmpresa($_SESSION['empresa_cnpj'])
        ];

        $dados += [
            'num_promocoes' => count($dados['promocoes'])
        ];

        $dados += [
            'num_curtidas' => $this->curtidaModel->curtidasTotais($_SESSION['empresa_cnpj'])
        ];

        $dados += [
            'num_seguidores' => $this->seguidorModel->seguidoresEmpresa($_SESSION['empresa_cnpj'])
        ];

        foreach ($dados['promocoes'] as $promocao) {
            $promocao->curtidas = $this->curtidaModel->curtidas($promocao->id);
            $promocao->denuncias = $this->denunciaModel->denuncias($promocao->id);
            if (date('d/m/y') >= date('d/m/Y', strtotime($promocao->data_inicio)) && date('d/m/y') <= date('d/m/Y', strtotime($promocao->data_fim))) :
                $ativos++;
            endif;
        }

        $dados += [
            'num_ativos' => $ativos
        ];

        $this->view('empresas/dashboard', $dados);
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cnpj' => trim($formulario['cnpj']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
                'nome' => trim($formulario['nome']),
                'endereco' => trim($formulario['endereco']),
                'categoria' => trim($formulario['categoria']),
                'telefone' => trim($formulario['telefone']),
            ];

            if (empty($formulario['cnpj'])) :
                $dados['cnpj_erro'] = 'Preencha o campo CNPJ.';
                $erro++;
            elseif (strlen($formulario['cnpj']) != 14) :
                $dados['cnpj_erro'] = 'Informe um CNPJ válido. Formato permitido: "XXXXXXXX000XXX" (apenas números)';
                $erro++;
            elseif ($this->empresaModel->checarCNPJ($formulario['cnpj'])) :
                $dados['cnpj_erro'] = 'O CNPJ informado já está cadastrado.';
                $erro++;
            endif;

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
                $dados['nome_erro'] = 'Preencha o campo nome fantasia.';
                $erro++;
            endif;

            if (empty($formulario['endereco'])) :
                $dados['endereco_erro'] = 'Preencha o campo endereço.';
                $erro++;
            endif;

            if (empty($formulario['categoria'])) :
                $dados['categoria_erro'] = 'Preencha o campo categoria.';
                $erro++;
            endif;

            if (empty($formulario['telefone'])) :
                $dados['telefone_erro'] = 'Preencha o campo telefone.';
                $erro++;
            elseif (strlen($formulario['telefone']) != 14) :
                $dados['telefone_erro'] = 'Informe um telefone válido. Formato permitido: "(XX)XXXXX-XXXX"';
                $erro++;
            endif;

            if ($erro == 0) :
                $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
                if ($this->empresaModel->incluir($dados)) :
                    Sessao::mensagem('empresa', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Empresa cadastrada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $dados = [
                        'cnpj' => '',
                        'email' => '',
                        'senha' => '',
                        'confirma_senha' => '',
                        'nome' => '',
                        'endereco' => '',
                        'categoria' => '',
                        'telefone' => '',
                    ];
                endif;
            endif;

        else :
            $dados = [
                'cnpj' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'nome' => '',
                'endereco' => '',
                'categoria' => '',
                'telefone' => '',
            ];
        endif;

        $this->view('empresas/cadastrar', $dados);
    }

    public function login()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cnpj' => trim($formulario['cnpj']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
            ];

            if (empty($formulario['cnpj'])) :
                $dados['cnpj_erro'] = 'Preencha o campo CNPJ.';
                $erro++;
            endif;

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
                $empresa = $this->empresaModel->checarLogin($formulario['cnpj'], $formulario['email'], $formulario['senha']);

                if ($empresa) :
                    $this->criarSessaoEmpresa($empresa);
                    $dados = [
                        'cnpj' => '',
                        'email' => '',
                        'senha' => '',
                    ];
                    URL::redirecionar('empresas/dashboard');
                else :
                    Sessao::mensagem('empresa', null, 'CNPJ, email ou senha inválidos!', null);
                endif;

            endif;

        else :
            $dados = [
                'cnpj' => '',
                'email' => '',
                'senha' => '',
            ];
        endif;

        $this->view('empresas/login', $dados);
    }

    private function criarSessaoEmpresa($empresa)
    {
        $_SESSION['empresa_cnpj'] = $empresa->cnpj;
        $_SESSION['empresa_nome'] = $empresa->nome;
    }

    public function sair()
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        unset($_SESSION['empresa_cnpj']);
        unset($_SESSION['empresa_nome']);
        session_destroy();
        URL::redirecionar('empresas/login');
    }

    public function editar()
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cnpj' => $_SESSION['empresa_cnpj'],
                'email' => trim($formulario['email']),
                'nome' => trim($formulario['nome']),
                'endereco' => trim($formulario['endereco']),
                'categoria' => trim($formulario['categoria']),
                'telefone' => trim($formulario['telefone']),
            ];

            if (empty($formulario['email'])) :
                $dados['email_erro'] = 'Preencha o campo email.';
                $erro++;
            elseif (filter_var($formulario['email'], FILTER_VALIDATE_EMAIL) == false) :
                $dados['email_erro'] = 'Informe um email válido.';
                $erro++;
            endif;

            if (empty($formulario['nome'])) :
                $dados['nome_erro'] = 'Preencha o campo nome fantasia.';
                $erro++;
            endif;

            if (empty($formulario['endereco'])) :
                $dados['endereco_erro'] = 'Preencha o campo endereço.';
                $erro++;
            endif;

            if (empty($formulario['categoria'])) :
                $dados['categoria_erro'] = 'Preencha o campo categoria.';
                $erro++;
            endif;

            if (empty($formulario['telefone'])) :
                $dados['telefone_erro'] = 'Preencha o campo telefone.';
                $erro++;
            endif;

            if ($erro == 0) :
                if ($this->empresaModel->editar($dados)) :
                    Sessao::mensagem('empresa', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Empresa editada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $empresa = $this->empresaModel->checarEmpresa($_SESSION['empresa_cnpj']);
                    $dados = [
                        'empresa' => $empresa
                    ];
                endif;
            endif;
        endif;

        $empresa = $this->empresaModel->checarEmpresa($_SESSION['empresa_cnpj']);
        $dados = [
            'empresa' => $empresa
        ];

        $this->view('empresas/perfil', $dados);
    }

    public function senha()
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cnpj' => $_SESSION['empresa_cnpj'],
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
                if ($this->empresaModel->senha($dados)) :
                    Sessao::mensagem('empresa', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Senha editada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $empresa = $this->empresaModel->checarEmpresa($_SESSION['empresa_cnpj']);
                    $dados = [
                        'empresa' => $empresa
                    ];
                else :
                    Sessao::mensagem('empresa', null, 'Ocorreu um erro ao editar a senha. Tente novamente!', null);
                endif;
            endif;
        endif;

        $empresa = $this->empresaModel->checarEmpresa($_SESSION['empresa_cnpj']);
        $dados = [
            'empresa' => $empresa
        ];

        $this->view('empresas/perfil', $dados);
    }

    public function perfil()
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        $empresa = $this->empresaModel->checarEmpresa($_SESSION['empresa_cnpj']);
        $dados = [
            'empresa' => $empresa
        ];

        $this->view('empresas/perfil', $dados);
    }
}
