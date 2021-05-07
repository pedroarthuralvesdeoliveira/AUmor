<?php

CLASS EnderecoControllerAcessar{
	public static function acessar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/endereco.class.php');
		require_once('../DAO/enderecodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new enderecoDAO($db);
		$endereco = new Endereco();

		if (isset($_SESSION['idEndereco'])) {
			return $dao->Acessar($endereco);
		}
	}
}
EnderecoControllerAcessar::acessar();
?>