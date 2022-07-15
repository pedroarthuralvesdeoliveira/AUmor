<?php

class EnderecoController
{
    public function acessar(){
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

    public function apagar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/endereco.class.php');
		require_once('../DAO/enderecodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new EnderecoDAO($db);
		$endereco = new Endereco();

		$endereco->setIdEndereco($_POST["idEndereco"]);
	}

    public function editar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/endereco.class.php');
		require_once('../DAO/enderecodao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new EnderecoDAO($db);
		$endereco = new Endereco();

		$endereco->setIdEndereco($_POST["idEndereco"]);
		$endereco->setCep($_POST["cep"]);
		$endereco->setBairro($_POST["bairro"]);
		$endereco->setRua($_POST["rua"]);
		$endereco->setNumero($_POST["numero"]);
		$endereco->setComplemento($_POST["complemento"]);

		$dao->Editar($endereco);
	}

    public function inserir(){
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

?>