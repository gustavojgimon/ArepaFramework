<?php

namespace App\Modelos;

use Core\Model;

class Empleado extends Model
{
    public $einfo_id;
    public $einfo_nombres;
    public $einfo_apellidos;
    public $einfo_telefono_movil;
    public $einfo_email;
    public $einfo_direccion_1;
    public $einfo_direccion_2;
    public $einfo_ciudad;
    public $einfo_estado;
    public $einfo_pais;
    public $einfo_imagenid;

    public function getUserInfo($user)
    {
        return $this->db->consultar("SELECT * FROM app_empleados WHERE emp_username='{$user}'")->row();
    }

    public function getUserPerData($id)
    {
        return $this->db->consultar("SELECT * FROM app_empleados_info WHERE einfo_id={$id}")->row();
    }

    public function totalEmpleados()
    {
        return $this->db->consultar('SELECT * FROM app_empleados WHERE emp_eliminado != 1')->count();
    }

    public function empleadosDatosCompletos()
    {
        return $this->db->consultar('SELECT * FROM app_empleados_info ei JOIN app_empleados e ON ei.einfo_id = e.emp_edatosid JOIN app_empleados_sucursales es ON es.empleado_id = e.emp_edatosid JOIN app_sucursales s ON es.sucursal_id = s.su_id')->all();
    }

    public function empleadosInfo()
    {
        return $this->db->consultar('SELECT * FROM app_empleados_info ei
    									LEFT JOIN app_empleados e ON ei.einfo_id = e.emp_edatosid')->all();
    }

    public function guardarEmpleadoInfo($data)
    {
        return $this->db->consultar("INSERT INTO app_empleados_info (einfo_nombres, einfo_apellidos, einfo_telefono_movil, einfo_email, einfo_direccion_1, einfo_direccion_2, einfo_ciudad, einfo_estado, einfo_pais) VALUES ('{$data['einfo_nombres']}', '{$data['einfo_apellidos']}', '{$data['einfo_telefono_movil']}', '{$data['einfo_email']}', '{$data['einfo_direccion_1']}', '{$data['einfo_direccion_2']}', '{$data['einfo_ciudad']}', '{$data['einfo_estado']}', '{$data['einfo_pais']}')")->run();
    }

    public function editarEmpleadoInfo($id_empleado, $data)
    {
        return $this->db->consultar("UPDATE app_empleados_info SET einfo_nombres='{$data['einfo_nombres']}', einfo_apellidos='{$data['einfo_apellidos']}', einfo_telefono_movil='{$data['einfo_telefono_movil']}', einfo_email='{$data['einfo_email']}', einfo_direccion_1='{$data['einfo_direccion_1']}', einfo_direccion_2='{$data['einfo_direccion_2']}', einfo_ciudad='{$data['einfo_ciudad']}', einfo_estado='{$data['einfo_estado']}', einfo_pais='{$data['einfo_pais']}' WHERE einfo_id = $id_empleado")->run();
    }

    public function obtenerEmpleadosInfoId($id_empleado)
    {
        return $this->db->consultar("SELECT *
								FROM app_empleados_info aei
								LEFT JOIN app_empleados ae ON aei.einfo_id=ae.emp_edatosid
								WHERE einfo_id = $id_empleado")
            ->row();
    }

    public function estatus($id_empleado)
    {
        return $this->db->consultar("SELECT emp_estatus FROM app_empleados WHERE emp_edatosid = $id_empleado")->all();
    }

    public function modificarEstatus($id_empleado, $estatus)
    {
        return $this->db->consultar("UPDATE app_empleados SET emp_estatus = $estatus WHERE emp_edatosid = $id_empleado")->run();
    }

    public function eliminarEmpleado($id_empleado)
    {
        return $this->db->consultar("UPDATE app_empleados SET emp_eliminado = 1 WHERE emp_edatosid = $id_empleado")->run();
    }

    /**     Method store save data
     * @param $person_data                      data de la persona login
     * @param $emp_id                        id de la persona
     * @param $employee_data                    data de la persona (datos personales)
     * @param $permission_data                  array de permisos
     * @param $permission_action_data array de  permisos de acciones
     */
    public function store_update($person_data, $emp_id, $employee_data, $permission_data, $permission_action_data): void
    {
        //1. actualizar informacion personal del empleados

        $success = $this->actualizar_info_empleado($person_data, $emp_id);

        //verificamos si se actualizó correctamente
        if (is_bool($success) && true === $success) {
            if (isset($employee_data['emp_username']) || isset($employee_data['emp_password'])) {
                //verificamos si existe una persona con el mismo emp_id
                if (0 === $this->exists($emp_id)) {
                    //obtengo los valores de $employee_data
                    $data = [
                        'emp_username' => $employee_data['emp_username'],
                        'emp_password' => $employee_data['emp_password'],
                        'emp_edatosid' => $emp_id,
                    ];
                    //insertamos datos del empleado
                    $this->guardarEmpleadoUsuario($data);
                } elseif (!empty($employee_data['emp_password'])) {
                    //actualizamos el usuario y la contraseña

                    $this->actualizarEmpleadoUsuarioPassword($employee_data['emp_username'], $employee_data['emp_password'], $emp_id);
                } else {
                    //actualizamos solo el usuario
                    $this->actualizarEmpleadoUsuario($employee_data['emp_username'], $emp_id);
                }
            }
            //2. permisos de usuario
            if (null !== $permission_data) {
                //Primero vamos a borrar los permisos que el empleado actual tiene.
                $this->db->consultar("DELETE FROM app_permissions WHERE emp_id=$emp_id");

                // Ahora insertamos los nuevos permisos
                foreach ($permission_data as $modulos_permitidos) {
                    $this->db->consultar("INSERT INTO app_permissions (module_id,emp_id) VALUES ('{$modulos_permitidos}','{$emp_id}')");
                }

                //Eliminamos tambien las acciones que tiene el usuario
                 $this->db->consultar("DELETE FROM app_permissions_actions WHERE emp_id=$emp_id");

                //Ahora insertamos los nuevos permisos
                foreach ($permission_action_data as $permission_action) {
                    list($module, $action) = explode('|', $permission_action);
                     $this->db->consultar("INSERT INTO app_permissions_actions (module_id,action_id,emp_id) VALUES ('{$module}','{$action}','{$emp_id}')");
                }
            }
        }
    }

    /**
     * @param $person_data
     * @param $emp_id
     *
     * @return mixed
     */
    public function actualizar_info_empleado($person_data, $emp_id)
    {
        $success = $this->db->consultar("UPDATE app_empleados_info
										SET
										einfo_nombres 			= '{$person_data['einfo_nombres']}',
										einfo_apellidos 		= '{$person_data['einfo_apellidos']}',
										einfo_telefono_movil 	= '{$person_data['einfo_telefono_movil']}',
										einfo_email 			= '{$person_data['einfo_email']}',
										einfo_direccion_1 		= '{$person_data['einfo_direccion_1']}',
										einfo_direccion_2 		= '{$person_data['einfo_direccion_2']}',
										einfo_ciudad 			= '{$person_data['einfo_ciudad']}',
										einfo_estado 			= '{$person_data['einfo_estado']}',
										einfo_pais 				= '{$person_data['einfo_pais']}',
										einfo_imagenid 			= 1
										WHERE einfo_id			= $emp_id")->run();

        return $success;
    }

    public function exists($emp_id)
    {
        $sql = "SELECT * FROM app_empleados WHERE emp_id = '{$emp_id}'";

        return $this->db->consultar($sql)->count();
    }

    public function guardarEmpleadoUsuario(array $data)
    {
        $sql = "INSERT INTO app_empleados (emp_username,emp_password,emp_edatosid) VALUES ('{$data['emp_username']}','{$data['emp_password']}','{$data['emp_edatosid']}')";

        return $this->db->consultar($sql)->run();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function actualizarEmpleadoUsuarioPassword($emp_username, $emp_password, $emp_id)
    {
        $sql = "UPDATE app_empleados
					SET emp_username='{$emp_username}',
						emp_password='{$emp_password}'
					WHERE emp_edatosid='{$emp_id}'";

        return $this->db->consultar($sql)->run();
    }

    /**
     * @param array $data
     */
    public function actualizarEmpleadoUsuario($emp_username, $emp_id)
    {
        $sql = "UPDATE app_empleados
					SET emp_username='{$emp_username}'
					WHERE emp_edatosid='{$emp_id}'";

        return $this->db->consultar($sql)->run();
    }

    public function existeEmpleado($emp_id): int
    {
        $sql = "SELECT * FROM app_empleados_info WHERE einfo_id = '{$emp_id}'";

        return $this->db->consultar($sql)->count();
    }
}