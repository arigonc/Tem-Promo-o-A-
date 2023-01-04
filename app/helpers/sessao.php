<?php

class Sessao
{
    public static function mensagem($nome, $i = null, $texto = null, $classe = null)
    {
        if (!empty($nome)) :
            if (!empty($texto) && empty($_SESSION[$nome])) :
                if (!empty($_SESSION[$nome])) :
                    unset($_SESSION[$nome]);
                endif;

                $_SESSION[$nome] = $texto;
                $_SESSION[$nome . 'classe'] = $classe;

            elseif (!empty($_SESSION[$nome]) && empty($texto)) :
                $classe = !empty($_SESSION[$nome . 'classe']) ? $_SESSION[$nome . 'classe'] : 'alert alert-danger d-flex align-items-center alert-dismissible fade show';
                $i = !empty($_SESSION[$nome . 'i']) ? $_SESSION[$nome . 'i'] : 'bi bi-exclamation-triangle-fill flex-shrink-0 me-1';
                echo '<div
                    class="' . $classe . '"
                    role="alert">
                    <i class="' . $i . '"></i>
                    <div>'. $_SESSION[$nome] .'</div>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

                unset($_SESSION[$nome]);
                unset($_SESSION[$nome . 'classe']);
            endif;
        endif;
    }

    public static function estaLogadoEmpresa(){
        if(isset($_SESSION['empresa_cnpj'])):
            return true;
        else:
            return false;
        endif;
    }

    public static function estaLogadoUsuario(){
        if(isset($_SESSION['usuario_email'])):
            return true;
        else:
            return false;
        endif;
    }
}
