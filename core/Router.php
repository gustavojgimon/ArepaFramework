<?php

namespace Core\Router;

    use Core\Sanitizer;

    class Router
    {
        // contiene la url de la peticion
        private static $url;
        // contiene el tipo de peticion : GET | POST
        private static $tipo = null;

        private static $segmento = null;

        private static $controlador = null;

        private static $metodo = null;

        private static $data = null;

        public static function analizarUri()
        {
            self::$url = Sanitizer::sanitizeURL(rtrim(substr($_SERVER['REQUEST_URI'], 1), '/'));
            self::$segmento = explode('/', self::$url);
            self::$tipo = $_SERVER['REQUEST_METHOD'];
            self::$data = (object) [];
            self::$data->obtenerParametros = isset(self::$segmento[3]) ? self::$segmento[3] : null;
            self::$data->obtenerParametros = ('' === self::$data->obtenerParametros) ? null : self::$data->obtenerParametros;
            self::$data->controlador = isset(self::$segmento[1]) ? self::$segmento[1] : DEFAULT_CONTROLADOR;
            self::$data->metodo = isset(self::$segmento[2]) ? self::$segmento[2] : DEFAULT_METODO;

            return [self::$data->controlador, self::$data->metodo, self::$data->obtenerParametros];
        }
    }
