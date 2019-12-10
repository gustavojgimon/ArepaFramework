<?php

namespace Core\FrontController;

use Core\Librerias\Http;
use Core\Router\Router;

class FrontController
{
    private static $ruta;

    public static function inicio() 
    {
        list($controlador, $metodo, $argumento) = Router::analizarUri();

        self::$ruta = 'app/Modulos/'.strtolower($controlador).'/controlador/'.ucfirst($controlador).'Controlador.php';

        $controladorNombre = ucwords($controlador).'Controlador';
        $controladorNombre = str_replace(' ', ' ', $controladorNombre);

        if (!file_exists(self::$ruta)) {
            Http::notFound();
        } else {
            $class = "App\\Controladores\\{$controladorNombre}";
            new $class($metodo, $argumento);
        }
    }
}
