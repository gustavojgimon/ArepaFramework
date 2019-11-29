<?php

namespace Core;

	class Model extends DbLayer
	{
		protected $resultado;
		protected $user;
		protected $conexion;
		protected $statement;
		protected $sql;
		protected $data;

		public function __construct()
		{
			$this->conexion = null;
			$this->statement = null;
			$this->sql = null;
			$this->data = null;
			$this->resultado = null;
			$this->user = null;
		}

		/***** metodos **/

		public function all($sql)
		{
			$this->sql = $sql;
			$this->statement = $this->conectar()->preparar($sql);
			$this->statement->execute();

			return $this->statement->fetchAll();
		}

		private function preparar($sql)
		{
			return $this->statement = $this->conexion->prepare($sql);
		}

		private function conectar()
		{
			$this->conexion = new DbLayer();

			return $this;
		}

		public function count($sql)
		{
			$this->sql = $sql;
			$this->statement = $this->conectar()->preparar($sql);
			$this->statement->execute();

			return $this->statement->rowCount();
		}

		public function row($sql)
		{
			$this->sql = $sql;
			$this->statement = $this->conectar()->preparar($sql);
			$this->statement->execute();

			return $this->statement->fetch();
		}

		public function __destruct()
		{
			$this->conexion = '';
			$this->conexion = null;
		}

		public function update($id, $tabla, $data, $where)
		{
			if (!is_array($data)) {
				$data = (array) $data;
				array_pop($data);
				array_pop($data);
				array_pop($data);
				array_pop($data);
				array_pop($data);
				array_pop($data);
			}

			$this->sql = "UPDATE $tabla SET ";
			foreach ($data as $key => $value) {
				$this->sql .= $key."='{$value}',";
			}
			$this->sql = substr($this->sql,0,-1);
			$this->sql .= " WHERE $where = $id";

			return $this->ejecutar($this->sql);
		}

		public function ejecutar($sql)
		{
			$this->sql = $sql;
			$this->statement = $this->conectar()->preparar($sql);

			return $this->statement->execute();
		}

		private function recorrerArray($array)
		{
			foreach ($array as $_array) {
				$_array[] = $_array;
			}

			return $_array;
		}
	}
