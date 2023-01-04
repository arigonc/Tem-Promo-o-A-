<?php

class Promocoes extends Controller
{
    public function __construct()
    {
        $this->promocaoModel = $this->model('Promocao');
        $this->empresaModel = $this->model('Empresa');
        $this->curtidaModel = $this->model('Curtida');
        $this->denunciaModel = $this->model('Denuncia');
    }

    public function curtir($id)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $curtida = $this->curtidaModel->checarCurtida($_SESSION['usuario_email'], $id);

        if ($curtida == false) :
            $this->curtidaModel->curtir($_SESSION['usuario_email'], $id);
        endif;

        URL::redirecionar('usuarios/promocoes');
    }

    public function descurtir($id)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $curtida = $this->curtidaModel->checarCurtida($_SESSION['usuario_email'], $id);

        if ($curtida == true) :
            $this->curtidaModel->descurtir($_SESSION['usuario_email'], $id);
        endif;

        URL::redirecionar('usuarios/promocoes');
    }

    public function denunciar($id)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;

        $denuncia = $this->denunciaModel->checarDenuncia($_SESSION['usuario_email'], $id);

        if ($denuncia == false) :
            $this->denunciaModel->denunciar($_SESSION['usuario_email'], $id);
        endif;

        URL::redirecionar('usuarios/promocoes');
    }

    public function inocentar($id)
    {
        if (!Sessao::estaLogadoUsuario()) :
            URL::redirecionar('usuarios/login');
        endif;
        
        $denuncia = $this->denunciaModel->checarDenuncia($_SESSION['usuario_email'], $id);

        if ($denuncia == true) :
            $this->denunciaModel->inocentar($_SESSION['usuario_email'], $id);
        endif;

        URL::redirecionar('usuarios/promocoes');
    }

    public function ver($id)
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;
        
        $promocao = $this->promocaoModel->promocaoPeloId($id);

        if ($promocao->cnpj != $_SESSION['empresa_cnpj']) :
            URL::redirecionar('empresas/dashboard');
        endif;

        $dados = [
            'promocao' => $promocao
        ];

        $this->view('promocoes/ver', $dados);
    }

    public function remover($id)
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $promocao = $this->promocaoModel->promocaoPeloId($id);
        $dados = [
            'promocao' => $promocao
        ];

        if ($dados['promocao']->cnpj != $_SESSION['empresa_cnpj']) :
            URL::redirecionar('empresas/dashboard');
        endif;

        if ($this->promocaoModel->remover($id)) :
            Sessao::mensagem('promocao', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Promoção removida com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
        else :
            Sessao::mensagem('promocao', null, 'Ocorreu um erro ao remover essa promoção. Tente novamente!', null);
        endif;

        URL::redirecionar('empresas/dashboard');
    }

    public function editar($id)
    {
        if (!Sessao::estaLogadoEmpresa()) :
            URL::redirecionar('empresas/login');
        endif;

        $promocao = $this->promocaoModel->promocaoPeloId($id);
        $dados = [
            'promocao' => $promocao
        ];

        if ($dados['promocao']->cnpj != $_SESSION['empresa_cnpj']) :
            URL::redirecionar('empresas/dashboard');
        endif;


        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'id' => $id,
                'cnpj' => $_SESSION['empresa_cnpj'],
                'titulo' => trim($formulario['titulo']),
                'marca' => trim($formulario['marca']),
                'validade' => trim($formulario['validade']),
                'descricao' => trim($formulario['descricao']),
                'data_inicio' => trim($formulario['data_inicio']),
                'data_fim' => trim($formulario['data_fim']),
                'imagem' => trim($formulario['imagem']),
                'preco_inicio' => trim($formulario['preco_inicio']),
                'preco_fim' => trim($formulario['preco_fim']),
            ];

            if (empty($formulario['titulo'])) :
                $dados['titulo_erro'] = 'Preencha o campo título.';
                $erro++;
            endif;

            if (empty($formulario['marca'])) :
                $dados['marca_erro'] = 'Preencha o campo marca.';
                $erro++;
            endif;

            if (empty($formulario['validade'])) :
                $dados['validade_erro'] = 'Preencha o campo validade.';
                $erro++;
            endif;

            if (empty($formulario['descricao'])) :
                $dados['descricao_erro'] = 'Preencha o campo descrição.';
                $erro++;
            endif;

            if (empty($formulario['data_inicio'])) :
                $dados['data_inicio_erro'] = 'Preencha o campo data de início.';
                $erro++;
            endif;

            if (empty($formulario['data_fim'])) :
                $dados['data_fim_erro'] = 'Preencha o campo data de encerramento.';
                $erro++;
            endif;

            if (empty($formulario['imagem'])) :
                $dados['imagem_erro'] = 'Preencha o campo imagem.';
                $erro++;
            endif;

            if (empty($formulario['preco_inicio'])) :
                $dados['preco_inicio_erro'] = 'Preencha o campo preço antes da promoção.';
                $erro++;
            endif;

            if (empty($formulario['preco_fim'])) :
                $dados['preco_fim_erro'] = 'Preencha o campo preço na promoção.';
                $erro++;
            endif;

            if ($erro == 0) :
                if ($this->promocaoModel->editar($dados)) :
                    Sessao::mensagem('promocao', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Promoção editada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $promocao = $this->promocaoModel->promocaoPeloId($id);
                    $dados = [
                        'promocao' => $promocao
                    ];
                else :
                    Sessao::mensagem('promocao', null, 'Oocrreu um erro ao editar essa promoção. Tente novamente!', null);
                endif;
            else :
                $dados += [
                    'promocao' => $promocao
                ];
            endif;
        endif;

        $this->view('promocoes/editar', $dados);
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $erro = 0;
            $dados = [
                'cnpj' => $_SESSION['empresa_cnpj'],
                'titulo' => trim($formulario['titulo']),
                'marca' => trim($formulario['marca']),
                'validade' => trim($formulario['validade']),
                'descricao' => trim($formulario['descricao']),
                'data_inicio' => trim($formulario['data_inicio']),
                'data_fim' => trim($formulario['data_fim']),
                'imagem' => trim($formulario['imagem']),
                'preco_inicio' => trim($formulario['preco_inicio']),
                'preco_fim' => trim($formulario['preco_fim']),
            ];

            if (empty($formulario['titulo'])) :
                $dados['titulo_erro'] = 'Preencha o campo título.';
                $erro++;
            endif;

            if (empty($formulario['marca'])) :
                $dados['marca_erro'] = 'Preencha o campo marca.';
                $erro++;
            endif;

            if (empty($formulario['validade'])) :
                $dados['validade_erro'] = 'Preencha o campo validade.';
                $erro++;
            endif;

            if (empty($formulario['descricao'])) :
                $dados['descricao_erro'] = 'Preencha o campo descrição.';
                $erro++;
            endif;

            if (empty($formulario['data_inicio'])) :
                $dados['data_inicio_erro'] = 'Preencha o campo data de início.';
                $erro++;
            endif;

            if (empty($formulario['data_fim'])) :
                $dados['data_fim_erro'] = 'Preencha o campo data de encerramento.';
                $erro++;
            endif;

            if (empty($formulario['imagem'])) :
                $dados['imagem_erro'] = 'Preencha o campo imagem.';
                $erro++;
            endif;

            if (empty($formulario['preco_inicio'])) :
                $dados['preco_inicio_erro'] = 'Preencha o campo preço antes da promoção.';
                $erro++;
            endif;

            if (empty($formulario['preco_fim'])) :
                $dados['preco_fim_erro'] = 'Preencha o campo preço na promoção.';
                $erro++;
            endif;
            
            if ($erro == 0) :
                if ($this->promocaoModel->incluir($dados)) :
                    Sessao::mensagem('promocao', 'bi bi-check-circle-fill flex-shrink-0 me-1', 'Promoção cadastrada com sucesso!', 'alert alert-success d-flex align-items-center alert-dismissible fade show');
                    $dados = [
                        'titulo' => '',
                        'marca' => '',
                        'validade' => '',
                        'descricao' => '',
                        'data_inicio' => '',
                        'data_fim' => '',
                        'imagem' => '',
                        'preco_inicio' => '',
                        'preco_fim' => '',
                    ];
                else :
                    Sessao::mensagem('promocao', null, 'Oocrreu um erro ao cadastrar essa promoção. Tente novamente!', null);
                endif;
            endif;

        else :
            $dados = [
                'titulo' => '',
                'marca' => '',
                'validade' => '',
                'descricao' => '',
                'data_inicio' => '',
                'data_fim' => '',
                'imagem' => '',
                'preco_inicio' => '',
                'preco_fim' => '',
            ];
        endif;

        $this->view('promocoes/cadastrar', $dados);
    }
}
