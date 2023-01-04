<?php

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarEmail($email)
    {
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);

        if ($this->db->resultado()) :
            return true;
        else :
            return false;
        endif;
    }

    public function checarUsuario($email)
    {
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);

        if ($this->db->resultado()) :
            return $this->db->resultado();
        else :
            return false;
        endif;
    }

    public function checarLogin($email, $senha)
    {
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);

        if ($this->db->resultado()) :
            $resultado = $this->db->resultado();
            if (password_verify($senha, $resultado->senha)) :
                return $resultado;
            else :
                return false;
            endif;
        else :
            return false;
        endif;
    }

    public function incluir($dados)
    {
        $this->db->query("INSERT INTO usuarios (email, senha, nome) VALUES (:email, :senha, :nome)");
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);
        $this->db->bind("nome", $dados['nome']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    public function senha($dados)
    {
        $this->db->query("UPDATE usuarios SET senha = :senha WHERE email = :email");

        $this->db->bind("senha", $dados['senha']);
        $this->db->bind("email", $dados['email']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }
}
