<?php

class Denuncia
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checarDenuncia($email, $id)
    {
        $this->db->query("SELECT * FROM denuncias WHERE email = :email AND id = :id");
        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if ($this->db->resultado()) :
            return true;
        else :
            return false;
        endif;
    }

    public function denuncias($id)
    {
        $this->db->query("SELECT * FROM denuncias WHERE id = :id");
        $this->db->bind("id", $id);

        return count($this->db->resultados());
    }

    public function denunciar($email, $id){
        $this->db->query("INSERT INTO denuncias (email, id) VALUES (:email, :id)");
        
        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function inocentar($email, $id)
    {
        $this->db->query("DELETE FROM denuncias WHERE email = :email AND id = :id");
        $this->db->bind("email", $email);
        $this->db->bind("id", $id);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
}