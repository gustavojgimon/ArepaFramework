<?php

/**
 * Created by PhpStorm.
 * User: gustavojgimon
 * Date: 3/12/19
 * Time: 5:05 PM.
 */

namespace Core\Librerias;

class Http
{
    /**
     * Clase que provee de métodos para respuestas HTTP.
     **/

    // Genera respuesta de error 404
    public static function notFound()
    {
        self::get_page(404);
        exit;
    }

    private static function get_page($num)
    {
        $constants = [
            403 => defined('HTTP_ERROR_403') ? HTTP_ERROR_403 : null,
            404 => defined('HTTP_ERROR_404') ? HTTP_ERROR_404 : null,
            'EE1001' => defined('HTTP_ERROR_EE1001') ? HTTP_ERROR_EE1001 : null,
        ];
        $default_page = "public/errores/$num.php";

        return require $default_page;
    }

    public static function exit_by_forbiden()
    {
        header('HTTP/1.1 403 Forbidden');
        self::get_page(403);
        exit();
    }

    public static function exit_by_ee1001()
    {
        echo file_get_contents(APP_DIR.self::get_page('EE1001'));
        exit();
    }

    public static function return_api_not_enabled()
    {
        header('HTTP/1.1 403 Forbidden');
        $default_page = 'core/Helpers/templates/403API.html';
        $html = (HTTP_ERROR_403_API) ? HTTP_ERROR_403_API : $default_page;
        echo file_get_contents(APP_DIR.$html);
        exit();
    }

    public static function go($uri = '')
    {
        exit(header("Location: $uri"));
    }

    //Genera una respuesta en json , esto es usado para trabajar
    //con ajax
    public static function json_response($data)
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: '.date('r'));
        header('Content-type: application/json');
        exit(json_encode($data));
    }
}
