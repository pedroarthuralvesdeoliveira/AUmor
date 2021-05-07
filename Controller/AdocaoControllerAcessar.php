<?php
CLASS AdocaoControllerAcessar{
	public static function acessar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/adocao.class.php');
		require_once('../DAO/adocaodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AdocaoDAO($db);
		
		if (isset($_GET["idAnimal"])) {
            return $dao->dadosAdocao($_GET["idAnimal"]);
		}
	}

	public static function devolucao(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/adocao.class.php');
		require_once('../DAO/adocaodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AdocaoDAO($db);

		if (isset($_GET["idAnimal"])) {
            return $dao->dadosDevolucao($_GET["idAnimal"]);
		}
	}

	public static function nomeAnimal(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/adocao.class.php');
		require_once('../DAO/adocaodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AdocaoDAO($db);
		
		if (isset($_GET["idAnimal"])) {
            return $dao->buscarNomeAnimal($_GET["idAnimal"]);
		}
	}
}
AdocaoControllerAcessar::acessar();
AdocaoControllerAcessar::devolucao();
AdocaoControllerAcessar::nomeAnimal();
?>