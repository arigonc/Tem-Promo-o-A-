<?php

class Seguidor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarSeguidor($email, $cnpj)
    {
        $this->db->query("SELECT * FROM seguidores WHERE email = :email AND cnpj = :cnpj");
        $this->db->bind("email", $email);
        $this->db->bind("cnpj", $cnpj);

        if ($this->db->resultado()) :
            return true;
        else :
            return false;
        endif;
    }

    public function seguidores($email)
    {
        $this->db->query("SELECT * FROM seguidores, empresas WHERE seguidores.cnpj = empresas.cnpj AND seguidores.email = :email");
        $this->db->bind("email", $email);
        return $this->db->resultados();
    }

    public function seguidoresEmpresa($cnpj)
    {
        $this->db->query("SELECT * FROM seguidores WHERE cnpj = :cnpj");
        $this->db->bind("cnpj", $cnpj);
        return count($this->db->resultados());
    }

    public function seguir($email, $cnpj)
    {
        $this->db->query("INSERT INTO seguidores (email, cnpj) VALUES (:email, :cnpj)");

        $this->db->bind("email", $email);
        $this->db->bind("cnpj", $cnpj);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    public function desseguir($email, $cnpj)
    {
        $this->db->query("DELETE FROM seguidores WHERE email = :email AND cnpj = :cnpj");
        $this->db->bind("email", $email);
        $this->db->bind("cnpj", $cnpj);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }
}
