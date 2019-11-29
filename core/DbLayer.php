<?php

namespace Core;

use PDO;

class DbLayer extends PDO
{
    public function __construct()
    {
		$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

		try {
            parent::__construct(''.DB_DRIVER.':host='.DB_HOST.';dbname='.BASEDATOS.'', DB_USUARIO, DB_PASS, $opciones);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
