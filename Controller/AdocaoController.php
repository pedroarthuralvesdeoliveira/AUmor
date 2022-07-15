<?php

class AdocaoController
{
    public function acessar(){
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

	public function devolucao(){
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

    public function devolver(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('../Model/adocao.class.php');
        require_once('../DAO/adocaodao.class.php');

        require_once('../Model/animal.class.php');
        require_once('../DAO/animaldao.class.php');

        require_once('../Config/database.class.php');

        $db = new Database();

        $adocao = new Adocao();
        $data = Date("Ymd");
        $adocao->setDataDevolucao($data);
        $dao = new AdocaoDAO($db);

        $daoAnimal = new AnimalDAO($db);

        if (isset($_GET["idAnimal"]) && isset($_GET["status"]) && isset($_GET["statusAdocao"])) {
            $dao->devolucaoAnimal($_GET["idAnimal"], $_GET["statusAdocao"], $adocao);
            $daoAnimal->alterarStatusAnimal($_GET["idAnimal"], $_GET["status"]);                
        }

        header('Location:../View/listarAnimaldoUsuario.php');
    }

	public function nomeAnimal(){
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

?>