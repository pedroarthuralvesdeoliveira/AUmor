<?php
CLASS EnderecoControllerInserir{
	public static function inserir(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/endereco.class.php');
		require_once('../DAO/enderecodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		
		$dao = new EnderecoDAO($db);
		$endereco = new Endereco();

		$endereco->setCep($_POST["cep"]);
		$endereco->setBairro($_POST["bairro"]);
		$endereco->setRua($_POST["rua"]);
		$endereco->setNumero($_POST["numero"]);
		$endereco->setComplemento($_POST["complemento"]);
		
		
		$dao->Inserir($endereco);
	}
}
EnderecoControllerInserir::inserir();	
?>