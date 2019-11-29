<?php

/**
 * Created by PhpStorm.
 * User: gustavojgimon
 * Date: 2/3/19
 * Time: 2:06 PM.
 */

namespace Core\Librerias;

use Core\ManejadorSession;
use Core\Model;

/**
 * Class Module.
 */
class Module
{
    protected $db = null;
    private $module_id;

    /**
     * Module constructor.
     *
     * @param null $module_id
     */
    public function __construct($module_id = null)
    {
        ManejadorSession::verificarSession();
        $this->db = new Model();
        $this->module_id = $module_id;
        if (null !== $this->module_id) {
            if (!$this->has_module_permission($this->module_id, $_SESSION['user_data']['emp_id'])) {
                Http::error_response();
            }
        }
    }

    /**
     * @param $module_id
     * @param $emp_id
     *
     * @return bool
     */
    public function has_module_permission($module_id, $emp_id)
    {
        $sql = "SELECT * FROM app_permissions
					WHERE  module_id = '{$module_id}'
					AND emp_id = {$emp_id}";

        //Si no es  module_id null, permite el acceso
        if (!$this->db->count($sql)) {
            return false;
        }

        return true;
    }

    /**
     * @param $module_id
     *
     * @return mixed
     */
    public function getModuleName(string $module_id)
    {
        $sql = "select * from app_modules where module_id = '$module_id'";

        return $this->db->row($sql);
    }

    /**
     * @param $module_id
     *
     * @return mixed
     */
    public function getModuleDesc(string $module_id)
    {
        $sql = "select * from app_modules
				where module_id = '{$module_id}'";

        return $this->db->all($sql);
    }

    /**
     * @return array|mixed
     */
    public function getAllModules()
    {
        $sql = 'select * from app_modules order by module_parentid asc';

        return $this->db->all($sql);
    }

    /**
     * @param $emp_id => este es el id del la persona
     *
     * @return array|mixed retorna un arreglo de los menu a los que tengo permisos
     */
    public function getAllowedModules(int $emp_id)
    {
        $sql = "select * from app_modules
					inner join app_permissions on app_permissions.module_id=app_modules.module_id
					where app_permissions.emp_id = '{$emp_id}'
					and app_modules.module_parentid ='' order by sort asc";

        return $this->db->all($sql);
    }

    /**
     * @param $emp_id => id de la persona logueada
     * @param $module_parentid => nombre del modulo padre
     *
     * @return array|mixed => retorno un arreglo con los submenus en caso de existir
     */
    public function getAllowedSubModules(string $emp_id, string $module_parentid)
    {
        $sql = "select * from app_modules
				inner join app_permissions on app_permissions.module_id=app_modules.module_id
				where app_modules.module_parentid = '{$module_parentid}'
				and app_permissions.emp_id = '{$emp_id}'  order by sort asc";

        return $this->db->all($sql);
    }

    public function countHaveSubMenu(string $emp_id, string $module_parentid)
    {
        $sql = "select * from app_modules
				inner join app_permissions on app_permissions.module_id=app_modules.module_id
				where app_modules.module_parentid = '{$module_parentid}'
				and app_permissions.emp_id = '{$emp_id}'";

        return $this->db->count($sql);
    }

    /**
     * @param $action_id
     */
    public function check_action_permission(string $action_id)
    {
        if (!$this->has_module_action_permission($this->module_id, $action_id, session('id'))) {
            header('Location:'.base_url().'403');
            exit;
        }
    }

    /**
     * @param $module_id
     * @param $action_id
     * @param $emp_id
     *
     * @return bool
     */
    public function has_module_action_permission($module_id, string $action_id, int $emp_id)
    {
        $sql = "select * from app_permissions_actions
						where emp_id =  '$emp_id'
				  		and module_id =  '$module_id'
				  		and action_id = '$action_id'";

        //Si no es  module_id null, permite el acceso
        if (!$this->db->count($sql)) {
            return false;
        }

        return true;
    }
}
