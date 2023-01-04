<?php

class Promocao
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function promocoesEmpresa($cnpj){
        $this->db->query("SELECT * FROM promocoes WHERE cnpj = :cnpj");
        $this->db->bind("cnpj", $cnpj);
        return $this->db->resultados();
    }

    public function promocoesFiltro($filtro=null, $email){
        if($filtro == 2):
            $this->db->query("SELECT * FROM promocoes INNER JOIN empresas ON promocoes.cnpj = empresas.cnpj INNER JOIN seguidores ON promocoes.cnpj = seguidores.cnpj AND seguidores.email = :email AND now() >= promocoes.data_inicio AND now() <= promocoes.data_fim ORDER BY promocoes.cadastro ASC");
            $this->db->bind("email", $email);
        else:
            $this->db->query("SELECT * FROM promocoes INNER JOIN empresas ON promocoes.cnpj = empresas.cnpj INNER JOIN seguidores ON promocoes.cnpj = seguidores.cnpj AND seguidores.email = :email AND now() >= promocoes.data_inicio AND now() <= promocoes.data_fim ORDER BY promocoes.cadastro DESC");
            $this->db->bind("email", $email);
        endif;
        return $this->db->resultados();
    }

    public function promocaoPeloId($id){
        $this->db->query("SELECT * FROM promocoes WHERE id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultado();
    }

    public function incluir($dados)
    {
        $this->db->query("INSERT INTO promocoes (cnpj, titulo, marca, validade, descricao, data_inicio, data_fim, imagem, preco_inicio, preco_fim) VALUES (:cnpj, :titulo, :marca, :validade, :descricao, :data_inicio, :data_fim, :imagem, :preco_inicio, :preco_fim)");
        
        $this->db->bind("cnpj", $dados['cnpj']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("marca", $dados['marca']);
        $this->db->bind("validade", $dados['validade']);
        $this->db->bind("descricao", $dados['descricao']);
        $this->db->bind("data_inicio", $dados['data_inicio']);
        $this->db->bind("data_fim", $dados['data_fim']);
        $this->db->bind("imagem", $dados['imagem']);
        $this->db->bind("preco_inicio", $dados['preco_inicio']);
        $this->db->bind("preco_fim", $dados['preco_fim']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function editar($dados)
    {
        $this->db->query("UPDATE promocoes SET titulo = :titulo, marca = :marca, validade = :validade, descricao = :descricao, data_inicio = :data_inicio, data_fim = :data_fim, imagem = :imagem, preco_inicio = :preco_inicio, preco_fim = :preco_fim WHERE id = :id");

        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("marca", $dados['marca']);
        $this->db->bind("validade", $dados['validade']);
        $this->db->bind("descricao", $dados['descricao']);
        $this->db->bind("data_inicio", $dados['data_inicio']);
        $this->db->bind("data_fim", $dados['data_fim']);
        $this->db->bind("imagem", $dados['imagem']);
        $this->db->bind("preco_inicio", $dados['preco_inicio']);
        $this->db->bind("preco_fim", $dados['preco_fim']);
        $this->db->bind("id", $dados['id']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function remover($id)
    {
        $this->db->query("DELETE FROM promocoes WHERE id = :id");
        $this->db->bind("id", $id);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
}
