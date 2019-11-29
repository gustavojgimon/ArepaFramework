<?php

namespace Core\Librerias;

	use Core\Helpers\Redireccion;

	class Token
	{
		public static function verificaToken()
		{
			$redirect = new Redireccion();
			if (!isset($_SESSION['csrf'][CSRF_TOKEN.'_token']) || $_SESSION['csrf'][CSRF_TOKEN.'_token']['token'] !== $_POST['token']) {
				$redirect->atras()->mensaje([
					'mensaje' => 'El intento de acceso no es valido y/o expiro, <br /> Refresque e intente de nuevo',
					'tipo' => 'error',
				]);
				exit();
			}

			return true;
		}

		public function crearToken($token_form)
		{
			$token = md5(uniqid(microtime(), true));
			$token_time = time();
			$_SESSION['csrf'][$token_form.'_token'] = ['token' => $token, 'time' => $token_time];

			return $token;
		}
	}
