<?php

namespace App\Controladores;

use App\Modelos\Empleado;
use Core\Controller;
use Core\Librerias\Http;
use Core\Librerias\Module;
use Core\Librerias\ModuleAction;
use Core\Librerias\Token;

class EmpleadosControlador extends Controller
{
    public $moduleAction;
    public $module;
    private $empleadoModel;

    public function __construct($metodo, $argumento)
    {
        $this->module = new Module('empleados');
        $this->empleadoModel = new Empleado();
        $this->moduleAction = new ModuleAction();
        parent::__construct($metodo, $argumento);
    }

    public function index()
    {
        return $this->view->view('empleados/index');
    }

    public function obtenerEmpleados()
    {
        Http::json_response($this->empleadoModel->empleadosInfo());
    }

    public function ver($argumento)
    {
        // obtener informacion del empleado enviada via get
        (!$this->empleadoModel->existeEmpleado($argumento) ? Http::error_response() : true);
        $data = [
            'all_modules' => $this->module->getAllModules(),
            'moduleActions' => $this->moduleAction,
            'empleado' => $this->empleadoModel->obtenerEmpleadosInfoId($argumento),
            'emp_id' => $argumento,
        ];

        return $this->view->view('empleados/ver', $data);
    }

    public function guardarEmpleadoInfo()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $data_form = [
                'einfo_nombres' => filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING),
                'einfo_apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING),
                'einfo_telefono_movil' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING),
                'einfo_email' => filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRIPPED),
                'einfo_direccion_1' => filter_input(INPUT_POST, 'direccion_uno', FILTER_SANITIZE_STRING),
                'einfo_direccion_2' => filter_input(INPUT_POST, 'direccion_dos', FILTER_SANITIZE_STRING),
                'einfo_ciudad' => filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING),
                'einfo_estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING),
                'einfo_pais' => filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING),
            ];

            if ($this->empleadoModel->guardarEmpleadoInfo($data_form)) {
                $data = true;
            } else {
                $data = false;
            }
            Http::json_response($data);
        }
    }

    public function verEmpleadoInfo($id)
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            Http::json_response($this->empleadoModel->obtenerEmpleadosInfoId($id));
        }
    }

    public function editarEmpleadoInfo()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $data_form = [
                'einfo_nombres' => filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING),
                'einfo_apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING),
                'einfo_telefono_movil' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING),
                'einfo_email' => filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRIPPED),
                'einfo_direccion_1' => filter_input(INPUT_POST, 'direccion_uno', FILTER_SANITIZE_STRING),
                'einfo_direccion_2' => filter_input(INPUT_POST, 'direccion_dos', FILTER_SANITIZE_STRING),
                'einfo_ciudad' => filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING),
                'einfo_estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING),
                'einfo_pais' => filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING),
            ];

            if ($this->empleadoModel->editarEmpleadoInfo($id, $data_form)) {
                $data = true;
            } else {
                $data = false;
            }

            Http::json_response($data);
        }
    }

    public function modificarEstatus($id)
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $estatus = $this->empleadoModel->estatus($id);
            if ($estatus) {
                $data = true;
                if ($estatus->emp_estatus) {
                    $this->empleadoModel->modificarEstatus($id, 0);
                } else {
                    $this->empleadoModel->modificarEstatus($id, 1);
                }
            } else {
                $data = false;
            }
            Http::json_response($data);
        }
    }

    public function eliminarEmpleado($id)
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($this->empleadoModel->eliminarEmpleado($id)) {
                $data = true;
            } else {
                $data = false;
            }
            Http::json_response($data);
        }
    }

    public function guardar($argumento)
    {
        $token = $_POST['token'];
        Token::verificaToken(CSRF_TOKEN, $token);

        //guardar informacion
        $person_data = [
            'einfo_id' => $argumento,
            'einfo_nombres' => $_POST['einfo_nombres'],
            'einfo_apellidos' => $_POST['einfo_apellidos'],
            'einfo_telefono_movil' => $_POST['einfo_telefono_movil'],
            'einfo_email' => $_POST['einfo_email'],
            'einfo_direccion_1' => $_POST['einfo_direccion_1'],
            'einfo_direccion_2' => $_POST['einfo_direccion_2'],
            'einfo_ciudad' => $_POST['einfo_ciudad'],
            'einfo_estado' => $_POST['einfo_estado'],
            'einfo_pais' => $_POST['einfo_pais'],
            'einfo_imagenid' => 1,
        ];

        // obtener permisos del usuario
        $permission_data = false !== $_POST['permissions'] ? $_POST['permissions'] : [];

        // obtener acciones del usuario
        $permission_action_data = false !== $_POST['permissions_actions'] ? $_POST['permissions_actions'] : [];

        // primero se elimina para evitar que se duplique la accion, ya que el usuario puede marcar o no.
        if (null !== $permission_data) {
            $permission_data = array_diff($permission_data, ['empleados']);
            $permission_data[] = 'empleados';
            $permission_action_data = array_diff(
                $permission_action_data,
                [
                    'empleados|add_update',
                    'empleados|search',
                ]
            );
            $permission_action_data[] = 'empleados|search';
            $permission_action_data[] = 'empleados|add_update';
        }

        //Cambio de contraseña
        if ('' !== $_POST['emp_password']) {
            $employee_data = [
                'emp_username' => trim($_POST['emp_username']),
                'emp_password' => password_hash(trim($_POST['emp_password'], PASSWORD_BCRYPT)),
            ];
        } else {
            //No cambio de clave
            $emp_username = '' === trim($_POST['emp_username']) ? null : trim($_POST['emp_username']);
            $employee_data = [
                'emp_username' => $emp_username,
            ];
        }

        $this->empleadoModel->store_update(
            $person_data,
            $person_data['einfo_id'],
            $employee_data,
            $permission_data,
            $permission_action_data
        );

        return $this->redirect->atras()->mensaje([
            'mensaje' => 'Registro creado exitosamente',
            'tipo' => 'success',
        ]);
    }
}
