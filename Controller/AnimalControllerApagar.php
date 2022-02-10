<?php
CLASS AnimalControllerApagar{
	public static function apagar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);

		if (isset($_GET["id"]) && isset($_GET["status"])) {
			$dao->Desativar($_GET["id"], $_GET["status"]);
		}
		
		header('Location:../View/listarAnimaldoUsuario.php');
	}
}
AnimalControllerApagar::apagar();
?>
