<?php

namespace App\Controllers;

class AdocaoController
{
	private $database;
	public function __construct(\Config\Database $database)
	{
		$this->database = $database;
	}

    public function acessar()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AdocaoDAO($this->database);
		
		if (isset($_GET["idAnimal"])) {
            return $dao->dadosAdocao($_GET["idAnimal"]);
		}
	}

	public function devolucao()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AdocaoDAO($this->database);

		if (isset($_GET["idAnimal"])) {
            return $dao->dadosDevolucao($_GET["idAnimal"]);
		}
	}

    public function devolver()
	{
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $adocao = new \App\Models\Adocao();
        $data = Date("Ymd");
        $adocao->setDataDevolucao($data);
        $dao = new \DAO\AdocaoDAO($this->database);
        $daoAnimal = new \DAO\AnimalDAO($this->database);

        if (isset($_GET["idAnimal"]) && isset($_GET["status"]) && isset($_GET["status"])) {
            $dao->devolucaoAnimal($_GET["idAnimal"], $_GET["status"], $adocao);
            $daoAnimal->alterarStatusAnimal($_GET["idAnimal"], $_GET["status"]);                
        }
        header('Location:../View/listarAnimaldoUsuario.php');
    }

	public function nomeAnimal()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$dao = new \DAO\AdocaoDAO($this->database);
		if (isset($_GET["idAnimal"])) {
            return $dao->buscarNomeAnimal($_GET["idAnimal"]);
		}
	}
}

?>