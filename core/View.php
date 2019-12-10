<?php

namespace Core;

use Core\Librerias\Token;
use Plasticbrain\FlashMessages\FlashMessages;


class View
{
    public $mensaje;
    public $token;
    protected $_vista_ruta = array();
    protected $_cached_vars = array();


    public function __construct()
    {
        $this->mensaje = new FlashMessages();
        $this->_vista_ruta = array( 'app/Modulos/' => TRUE);
    }

    // --------------------------------------------------------------------

    /**
     * Load View
     *
     * Esta función se utiliza para cargar un archivo "vista". Tiene tres parámetros:
     * *
     * 1. El nombre del archivo "vista" que se incluirá.
     * 2. Una matriz asociativa de datos que se extraerán para usar en la vista.
     * 3. VERDADERO / FALSO: si devolver los datos o cargarlos. En
     * en algunos casos es ventajoso poder devolver datos para que
     * Un desarrollador puede procesarlo de alguna manera.
     *
     * @param string
     * @param array
     * @param bool
     * @return    void
     */
    public function view($vista, $vars = array(), $return = FALSE)
    {
        return $this->_cargar(array(
                '_vista' => $vista,
                '_vars' => $this->_objectoArray($vars),
                '_return' => $return)
        );
    }


    public function viewAJAX($vista, $vars = array(), $return = FALSE)
    {
        return $this->_cargar_ajax(array(
                '_vista' => $vista,
                '_vars' => $this->_objectoArray($vars),
                '_return' => $return)
        );
    }

    /**
     * Loader
     *
     * Esta función se usa para cargar vistas y archivos.
     * Las variables tienen el prefijo _ci_ para evitar la colisión de símbolos con
     * variables disponibles para ver archivos
     *
     * @param array
     * @return    void
     */
    protected function _cargar($_ci_data)
    {

        $token = new Token();
        // Establecer las variables de datos predeterminadas
        foreach (array('_vista', '_vars', '_ruta', '_return') as $_val) {
            $$_val = (!isset($_ci_data[$_val])) ? FALSE : $_ci_data[$_val];
        }


        $file_exists = FALSE;

        // Establecer la ruta al archivo solicitado
        if ($_ruta != '') {
            $_x = explode('/', $_ruta);

            $_file = end($_x);
        } else {
            $_ext = pathinfo($_vista, PATHINFO_EXTENSION);
            $_file = ($_ext == '') ? $_vista . '.php' : $_vista;

            $_separar = explode('/', $_file);

            $array = array();
            foreach ($_separar as $key => $value) {
                if ($key == 1) {
                    array_push($array, 'vista');
                }
                array_push($array, $value);

            }

            $_file = implode($array, '/');


            foreach ($this->_vista_ruta as $vista_file => $cascade) {

                if (file_exists($vista_file . $_file)) {
                    $_ruta = $vista_file . $_file;
                    $file_exists = TRUE;
                    break;
                }

                if (!$cascade) {
                    break;
                }
            }
        }

        if (!$file_exists && !file_exists($_ruta)) {
            echo "No se puede cargar el archivo solicitado: " . $_file;
        }


        if (is_array($_vars)) {
            $this->_cached_vars = array_merge($this->_cached_vars, $_vars);
        }
        extract($this->_cached_vars);


        require 'public/layout/head.php';
        require 'public/layout/header.php';
        require 'public/layout/sidebar.php';
        $this->mensaje->display();
        require $_ruta;
        require 'public/layout/footer.php';


    }


    protected function _cargar_ajax($_ci_data)
    {

        $token = new Token();
        // Establecer las variables de datos predeterminadas
        foreach (array('_vista', '_vars', '_ruta', '_return') as $_val) {
            $$_val = (!isset($_ci_data[$_val])) ? FALSE : $_ci_data[$_val];
        }


        $file_exists = FALSE;

        // Establecer la ruta al archivo solicitado
        if ($_ruta != '') {
            $_x = explode('/', $_ruta);

            $_file = end($_x);
        } else {
            $_ext = pathinfo($_vista, PATHINFO_EXTENSION);
            $_file = ($_ext == '') ? $_vista . '.php' : $_vista;

            $_separar = explode('/', $_file);

            $array = array();
            foreach ($_separar as $key => $value) {
                if ($key == 1) {
                    array_push($array, 'vista');
                }
                array_push($array, $value);

            }

            $_file = implode($array, '/');


            foreach ($this->_vista_ruta as $vista_file => $cascade) {

                if (file_exists($vista_file . $_file)) {
                    $_ruta = $vista_file . $_file;
                    $file_exists = TRUE;
                    break;
                }

                if (!$cascade) {
                    break;
                }
            }
        }

        if (!$file_exists && !file_exists($_ruta)) {
            echo "No se puede cargar el archivo solicitado: " . $_file;
        }


        if (is_array($_vars)) {
            $this->_cached_vars = array_merge($this->_cached_vars, $_vars);
        }
        extract($this->_cached_vars);


        $this->mensaje->display();
        require($_ruta);
        return;
    }

    // --------------------------------------------------------------------

    /**
     * Objecto a Array
     *
     * Toma un objeto como entrada y convierte las variables de clase en clave de matriz / vals
     *
     * @param object
     * @return    array
     */
    protected function _objectoArray($object)
    {
        return (is_object($object)) ? get_object_vars($object) : $object;
    }
}