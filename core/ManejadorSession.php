<?php

namespace Core;

use App\Modelos\Empleado;
use Core\Model as Model;

/* * ****************************************** */

class ManejadorSession extends Model
{
    /* atrubutos */

    public $user;
    public $pass;
    public $error;

    public static function verificarSession()
    {
        if (!isset($_SESSION['logueado']) || !isset($_SESSION['user_data'])) {
            return self::redirecionarlogin();
        }
    }

    public static function redirecionarlogin()
    {
        header('Location: '.APP_DIR.'login');
        exit();
    }

    public static function procesarLogin()
    {
        if ($_POST['user'] && $_POST['pass']) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            self::verificarUserdatos($user, $pass);
        } else {
            if (!isset($_GET['info'])) {
                self::destruirSession();
                exit();
            }
        }
    }

    public static function verificarUserdatos($user, $pass)
    {
        //Validación de los datos de accesos indicados por el usuario;
        $empleado_model = new Empleado();
        $usuario = $empleado_model->getUserInfo($user);

        if (isset($usuario->emp_id)) {
            $usuario_personales = $empleado_model->getUserPerData($usuario->emp_id);
            $usuario_datos = [
                'emp_id' => $usuario->emp_id,
                'emp_username' => $usuario->emp_username,
                'einfo_nombres' => $usuario_personales->einfo_nombres,
                'einfo_apellidos' => $usuario_personales->einfo_apellidos,
                'einfo_email' => $usuario_personales->einfo_email,
                'einfo_telfono' => $usuario_personales->einfo_telfono,
                'einfo_direccion_1' => $usuario_personales->einfo_direccion_1,
                'einfo_direccion_2' => $usuario_personales->einfo_direccion_2,
                'einfo_ciudad' => $usuario_personales->einfo_ciudad,
                'einfo_estado' => $usuario_personales->einfo_estado,
            ];
            if (password_verify($pass, $usuario->emp_password)) {
                self::inicioSession($usuario_datos);
            } else {
                self::destruirSession();
            }
        } else {
            self::destruirSession();
        }
    }

    public static function inicioSession($usuario_datos)
    {
        //Inicialización de la sesión;
        session_start();
        $_SESSION['logueado'] = '1';
        $_SESSION['user_data'] = $usuario_datos;
        header('Location: '.APP_DIR);
        exit();
    }

    public static function destruirSession()
    {
        //Destrucción de una sesión.
        session_start();
        session_destroy();

        self::redirecionarlogin();
    }
}
