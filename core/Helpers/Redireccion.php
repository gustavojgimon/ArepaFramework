<?php

namespace Core\Helpers;

use Plasticbrain\FlashMessages\FlashMessages;

class Redireccion
{
    private $mensaje;
    private $tipo;
    private $data = [];

    public function __construct()
    {
        return $this;
    }

    public function atras()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        return $this;
    }

    public function ruta($ruta)
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . APP_DIR . $ruta);
        }

        return $this;
    }

    public function errores($errores)
    {
        $this->flash = new FlashMessages();
        foreach ($errores as $error) {
            $this->flash->error("$error",'impuestos');
        };
        return $this;
    }


    public function mensaje(array $data = null)
    {
        $this->flash = new FlashMessages();
        isset($data['tipo']) ? $this->tipo = $data['tipo'] : $this->tipo = 'success';
        isset($data['mensaje']) ? $this->mensaje = $data['mensaje'] : $this->mensaje = 'Operación realizada exitosamente';
        $this->flash->{$this->tipo}("{$this->mensaje}");
        return $this;
    }
}
