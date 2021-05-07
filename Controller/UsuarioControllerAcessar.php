<?php
	CLASS UsuarioControllerAcessar {
		public static function acessar(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once('../Model/usuario.class.php');
			require_once('../DAO/usuariodao.class.php');
			require_once('../Config/database.class.php');

			$db = new Database();
			$dao = new UsuarioDAO($db);
			$usuario = new Usuario();

			if (isset($_SESSION['idUsuario'])){
				return $dao->Acessar($usuario);
			}
		}

		public static function acessarParaEditarAnimal(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once('../Model/usuario.class.php');
			require_once('../DAO/usuariodao.class.php');
			require_once('../Config/database.class.php');

			$db = new Database();
			$dao = new UsuarioDAO($db);
			$usuario = new Usuario();

			if (isset($_GET['idUsuario'])){
				return $dao->Acessar($usuario);
			}
		}
	}
	UsuarioControllerAcessar::acessar();
	UsuarioControllerAcessar::acessarParaEditarAnimal();
?>
