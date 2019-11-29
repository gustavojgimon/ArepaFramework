<?php

namespace Core\Helpers;

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of class.
     *
     * @author anonymous
     */
    class Seguridad
    {
        /**
         * @var type esto es para tomar los datos del la capa de
         *           encriptacion
         */
        public static function encriptar($contrasena)
        {
            $encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

            return $encriptada;
        }

        public static function verificar($conVirgen, $conEncriptada)
        {
            $descriptada = password_verify($conVirgen, $conEncriptada);

            return $descriptada;
        }

        /**
         * validar si envio el metodo oculto.
         */
        public static function validarMetodo($metodo)
        {
            if ($_POST['_metodo'] !== $metodo) {
                header('Location:/404');
                exit();
            }
        }

        public function respuesta($argumento)
        {
            if (isset($argumento)) {
                Tirien\Alert::set('success', 'puede');
            } else {
                Tirien\Alert::set('error', 'no puede');
            }
        }
    }
