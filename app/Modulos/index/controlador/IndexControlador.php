<?php

namespace App\Controladores;

use App\Modelos\Cliente;
use App\Modelos\Empleado;
use Core\Controller;

/**
 * Created by PhpStorm.
 * User: anonymous
 * Date: 24/05/18
 * Time: 15:25.
 */
class IndexControlador extends Controller
{
    public $empleado_model;
    public $cliente_model;

    public function __construct($metodo, $argumento)
    {
  
        parent::__construct($metodo, $argumento);
    }

    public function index()
    {
        return		$this->view->view('index/index');
    }
}
