<?php

namespace Core;

use PDO;
use PDOException;

class BaseDeDatos
{
    static $_instance;
    public $db;

    private function __construct()
    {
        $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

        try {
            $this->db = new PDO('' . DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . BASEDATOS . '', DB_USUARIO, DB_PASS, $opciones);
        } catch (PDOException $e) {
            die("Error al conectarse a la base de datos");
        }
        return $this->db;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function consultar($sql)
    {
        $this->statement = $this->db->prepare($sql);
        return $this;
    }

    public function run()
    {
        return $this->statement->execute();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $this->run();
        return $this->statement->fetchAll();
    }

    /**
     * @return mixed
     */
    public function row()
    {
        $this->run();
        return $this->statement->fetch();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        $this->run();
        return $this->statement->rowCount();
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}
