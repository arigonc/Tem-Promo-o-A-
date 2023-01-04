<?php

class Empresa
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarCNPJ($cnpj)
    {
        $this->db->query("SELECT cnpj FROM empresas WHERE cnpj = :cnpj");
        $this->db->bind(":cnpj", $cnpj);

        if ($this->db->resultado()) :
            return true;
        else :
            return false;
        endif;
    }

    public function checarEmpresa($cnpj)
    {
        $this->db->query("SELECT * FROM empresas WHERE cnpj = :cnpj");
        $this->db->bind(":cnpj", $cnpj);

        if ($this->db->resultado()) :
            return $this->db->resultado();
        else :
            return false;
        endif;
    }

    public function listarEmpresas($pesquisa = null)
    {
        if ($pesquisa == null) :
            $this->db->query("SELECT * FROM empresas");
            return $this->db->resultados();
        else :
            $this->db->query("SELECT * FROM empresas WHERE nome LIKE :pesquisa");
            $this->db->bind(":pesquisa", $pesquisa);
            return $this->db->resultados();
        endif;
    }

    public function checarLogin($cnpj, $email, $senha)
    {
        $this->db->query("SELECT * FROM empresas WHERE cnpj = :cnpj");
        $this->db->bind(":cnpj", $cnpj);

        if ($this->db->resultado()) :
            $resultado = $this->db->resultado();
            if ($resultado->email == $email) :
                if (password_verify($senha, $resultado->senha)) :
                    return $resultado;
                else :
                    return false;
                endif;
            else :
                return false;
            endif;
        else :
            return false;
        endif;
    }

    public function incluir($dados)
    {
        $this->db->query("INSERT INTO empresas (cnpj, email, senha, nome, endereco, categoria, telefone) VALUES (:cnpj, :email, :senha, :nome, :endereco, :categoria, :telefone)");
        $this->db->bind("cnpj", $dados['cnpj']);
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);
        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("endereco", $dados['endereco']);
        $this->db->bind("categoria", $dados['categoria']);
        $this->db->bind("telefone", $dados['telefone']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    public function editar($dados)
    {
        $this->db->query("UPDATE empresas SET email = :email, nome = :nome, endereco = :endereco, categoria = :categoria, telefone = :telefone WHERE cnpj = :cnpj");

        $this->db->bind("email", $dados['email']);
        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("endereco", $dados['endereco']);
        $this->db->bind("categoria", $dados['categoria']);
        $this->db->bind("telefone", $dados['telefone']);
        $this->db->bind("cnpj", $dados['cnpj']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    public function senha($dados)
    {
        $this->db->query("UPDATE empresas SET senha = :senha WHERE cnpj = :cnpj");

        $this->db->bind("senha", $dados['senha']);
        $this->db->bind("cnpj", $dados['cnpj']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }
}
