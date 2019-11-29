<?php

namespace App\Controladores;

    use Core\ManejadorSession;
    use Core\View as View;

    class LoginControlador
    {
        public $user;
        public $pass;
        private $vista;

        public function __construct($metodo, $argumento)
        {
            $this->vista = new View();
            if (is_callable([$this, $metodo])) {
                return call_user_func([$this, $metodo], $argumento);
            } else {
                header('Location: 404');
            }
        }

        public function index()
        {
            (1 === @$_SESSION['logueado']) ? header('Location: '.APP_DIR) : '/login';

            return $this->vista->viewAJAX('login/login');
        }

        public function acceso()
        {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            return ManejadorSession::procesarLogin($user, $pass);
        }

        public function salir()
        {
            return ManejadorSession::destruirSession();
        }
    }
