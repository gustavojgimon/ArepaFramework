<?php

namespace Core;

class Model
{
    public $db;
    public function __construct()
    {
        $this->db = BaseDeDatos::getInstance();
    }

    public function actualizar($id, $tabla, $data, $where)
    {

        if (!is_array($data)) {
            $data = (array)$data;
            unset($data["db"]);
        }

        $this->sql = "UPDATE $tabla SET ";

        foreach ($data as $key => $value) {
            $this->sql .= $key . "='{$value}',";
        }

        $this->sql = substr($this->sql, 0, -1);

      echo  $this->sql .= " WHERE $where = $id";

        return $this->db->consultar($this->sql)->run();
    }

    public function insertar($tabla, $data, $ultimoId = false)
    {
        if (!is_array($data)) {
            $data = (array)$data;
            unset($data["db"]);
        }

        $this->sql = "INSERT INTO $tabla (";

        foreach ($data as $key => $value) {
            $this->sql .= $key . ',';
        }

        $this->sql = substr($this->sql, 0, -1);
        $this->sql .= ")";
        $this->sql .= "VALUES (";

        foreach ($data as $key => $value) {
            $this->sql .= "'{$value}',";
        }

        $this->sql = substr($this->sql, 0, -1);
        $this->sql .= ")";

        $sql = $this->db->consultar($this->sql)->run();

        if ($ultimoId === true) {
            return $this->db->lastInsertId();
        }

        return $sql;
    }
}
