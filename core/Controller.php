<?php

namespace Core;

use Core\Helpers\Redireccion;
use Core\Librerias\Http;
use Core\Librerias\Module;
use Plasticbrain\FlashMessages\FlashMessages;

interface IController
{
    public function index();

    public function crear();

    public function ver($data);

    public function editar();

    public function guardar();

    public function actualizar();

    public function buscar();

    public function eliminar($data);
}

class Controller extends Module
{
    public $view;
    public $redirect;

    public function __construct($metodo, $argumento)
    {
        parent::__construct();
        if (is_callable([$this, $metodo])) {
            $this->view = new View();
            $this->redirect = new Redireccion();
            $this->mensaje = new FlashMessages();
            call_user_func([$this, $metodo], $argumento);
        } else {
            Http::exit_by_forbiden();
        }
    }

    public function __get($valor)
    {
        return $this->$nombre = $valor;
    }

    public function __set($nombre, $valor)
    {
        return $this->$nombre = $valor;
    }
}
