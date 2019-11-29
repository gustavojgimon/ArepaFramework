<?php

namespace Core;

use Core\Librerias\Token;
use Plasticbrain\FlashMessages\FlashMessages;

class View
{
    public $mensaje;
    public $token;
    private $segmentos;

    public function __construct()
    {
        $this->token = new Token();
        $this->mensaje = new FlashMessages();
    }

    public function view(string $vista, array $data = null)
    {
        $token = new Token();
        $this->mensaje = new FlashMessages();
        $this->segmentos = explode('/', $vista);
        $this->segmentos = array_filter($this->segmentos);
        if (null !== $data) {
            $data = (array) $data;
            foreach ($data as $id_assoc => $valor) {
                ${$id_assoc} = $valor;
            }
        }
        require 'public/layout/head.php';
        require 'public/layout/header.php';
        require 'public/layout/sidebar.php';
        $this->mensaje->display();
        require "app/Modulos/{$this->segmentos[0]}/vista/{$this->segmentos[1]}.php";
        require 'public/layout/footer.php';

        return;
    }

    public function viewAJAX(string $vista, array $data = null)
    {
        $token = new Token();
        $this->mensaje = new FlashMessages();
        $this->segmentos = explode('/', $vista);
        $this->segmentos = array_filter($this->segmentos);
        if (null !== $data) {
            foreach ($data as $id_assoc => $valor) {
                ${$id_assoc} = $valor;
            }
        }
        require "app/Modulos/{$this->segmentos[0]}/vista/{$this->segmentos[1]}.php";

        return;
    }
}
