<?php
CLASS ListaInteresseControllerAcessar{

	public static function acessar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/ListaInteresse.class.php');
		require_once('../DAO/listaInteressedao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new ListaInteresseDAO($db);

		return $dao->Acessar();

	}

	public static function buscarLista(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/ListaInteresse.class.php');
		require_once('../DAO/listaInteressedao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new ListaInteresseDAO($db);

		if (isset($_GET["idAnimal"]) && isset($_GET["idAnimal"])) {
			return $dao->buscarLista($_GET["idAnimal"]);
		}
	}

	public static function buscarUsuario(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/ListaInteresse.class.php');
		require_once('../DAO/listaInteressedao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new ListaInteresseDAO($db);

		if (isset($_GET["idUsuario"])) {
			return $dao->buscarUsuario($_GET["idUsuario"]);
		}
	}

	public static function buscarNomeAnimal(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/ListaInteresse.class.php');
		require_once('../DAO/listaInteressedao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new ListaInteresseDAO($db);

		if (isset($_GET["idAnimal"])) {
			return $dao->buscarNomeAnimal($_GET["idAnimal"]);
		}
	}
}
ListaInteresseControllerAcessar::acessar();
ListaInteresseControllerAcessar::buscarUsuario();
ListaInteresseControllerAcessar::buscarLista();
ListaInteresseControllerAcessar::buscarNomeAnimal();
?>
