<?php

class Rota {
    private $controller = 'inicio';
    private $method = 'inicio';
    private $parameters = [];

    public function __construct()
    {
        $url = $this->url() ? $this->url() : [0]; //se a url existe, senão

        if(file_exists('../app/controllers/'.$url[0].'.php')): //verifica se o arquivo existe
            $this->controller = $url[0]; //pega o primeiro termo da url
            unset($url[0]); //depois de ter pego, exclui o primeiro termo da url
        endif;

        require_once '../app/controllers/'.$this->controller.'.php'; //busca o arquivo
        $this->controller = new $this->controller; //instancia

        if(isset($url[1])):
            if(method_exists($this->controller, $url[1])):
                $this->method = $url[1];
                unset($url[1]);
            endif;
        endif;

        $this->parameters = $url ? array_values($url) : []; //verifica se existe parâmetros e retorna
        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

    private function url(){
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        if(isset($url)): //verifica se a url existe
            $url = trim(rtrim($url, '/')); //remove espaços e caracteres finais
            $url = explode('/', $url); //separa a url quando tiver /
            return $url;
        endif;
    }
}