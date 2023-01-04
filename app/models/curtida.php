<?php

class Curtida
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarCurtida($email, $id)
    {
        $this->db->query("SELECT * FROM curtidas WHERE email = :email AND id = :id");
        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if ($this->db->resultado()) :
            return true;
        else :
            return false;
        endif;
    }

    public function curtidas($id)
    {
        $this->db->query("SELECT * FROM curtidas WHERE id = :id");
        $this->db->bind("id", $id);

        return count($this->db->resultados());
    }

    public function curtidasTotais($cnpj)
    {
        $this->db->query("SELECT * FROM curtidas INNER JOIN promocoes WHERE promocoes.cnpj = :cnpj AND promocoes.id = curtidas.id");
        $this->db->bind("cnpj", $cnpj);

        return count($this->db->resultados());
    }

    public function curtir($email, $id)
    {
        $this->db->query("INSERT INTO curtidas (email, id) VALUES (:email, :id)");

        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    public function descurtir($email, $id)
    {
        $this->db->query("DELETE FROM curtidas WHERE email = :email AND id = :id");
        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }
}
