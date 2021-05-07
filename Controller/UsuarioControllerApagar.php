<?php
CLASS UsuarioControllerApagar{
	public static function apagar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/usuario.class.php');
		require_once('../DAO/usuariodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new UsuarioDAO($db);
		
		if (isset($_GET["id"])) {
			$dao->Desativar($_GET["id"]);
		}
	}
}
UsuarioControllerApagar::apagar();
?>
