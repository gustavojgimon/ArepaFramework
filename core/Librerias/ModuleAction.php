<?php

namespace Core\Librerias;

use Core\BaseDeDatos;

class ModuleAction
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDeDatos::getInstance();
    }

    public function getModuleActionName($module_id, $action_id)
    {
        return $this->db->consultar("SELECT * FROM app_modules_actions WHERE action_id='{$action_id}' AND module_id='{$module_id}'")
            ->all();
    }

    public function getModuleActions($module_id)
    {
        return $this->db->consultar("SELECT * FROM app_modules_actions WHERE module_id='{$module_id}'")
            ->all();
    }

    public function getAllowedModuleActions($module_id, $emp_id)
    {
        return $this->db->consultar("SELECT * FROM app_modules_actions amc
								INNER JOIN 	app_permissions_actions apa ON apa.module_id=amc.module_id
								WHERE apa.emp_id='{$emp_id}'")
            ->all();
    }
}
