<?php

class ListaInteresseController
{
    public function acessar(){
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

	public function buscarLista(){
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

	public function buscarUsuario(){
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

	public function buscarNomeAnimal(){
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

    public static function desistir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('../DAO/listaInteressedao.class.php');
        require_once('../Config/database.class.php');
        $db = new Database();
        $lista = new ListaInteresseDAO($db);

        $lista->ApagarUsuariodaLista($_GET["idUsuario"], $_GET["idAnimal"]);

        header('Location:../View/usuarioAnimaisInteressados.php?idUsuario='.$_GET["idUsuario"]);
    }

    public static function inserir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('../Model/listaInteresse.class.php');
        require_once('../DAO/listaInteressedao.class.php');
        require_once('../Config/database.class.php');
        
        $db = new Database();
        $dao = new ListaInteresseDAO($db);

        if(empty($_SESSION['idUsuario'])) {
            header('Location:../View/login.php');
        } else {        
            if ($_SESSION['statusValidacao'] == 0){
                echo "valide seu email para realizar a adoção";
            } else {
                if(isset($_GET['idUsuario']) && isset($_GET['idAnimal'])){
                    $dao->AdicionarUsuarioEmListaInteresse($_GET['idUsuario'], $_GET['idAnimal']);
                    header('Location:../View/usuarioAnimaisInteressados.php?idUsuario='.$_GET['idUsuario']);
                }
            }
        }
    }

    public function permitir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('../Model/adocao.class.php');
        require_once('../DAO/adocaodao.class.php');

        require_once('../Model/animal.class.php');
        require_once('../DAO/animaldao.class.php');

        require_once('../Model/listaInteresse.class.php');
        require_once('../DAO/listaInteressedao.class.php');

        require_once('../Config/database.class.php');

        $db = new Database();

        $dao = new AdocaoDAO($db);

        $daoLista = new ListaInteresseDAO($db);

        $daoAnimal = new AnimalDAO($db);

        if (isset($_GET["idUsuario"]) && isset($_GET["idAnimal"]) && isset($_GET["status"])) {

            $adocaoExiste = $dao->buscarAdocao($_GET["idUsuario"], $_GET["idAnimal"]);
            $existeRegistro = $daoLista->buscarUsuarioAnimalLista($_GET["idUsuario"], $_GET["idAnimal"]);

            if (empty($adocaoExiste)) {
                $dao->Inserir($_GET["idUsuario"], $_GET["idAnimal"]);
                $daoAnimal->alterarStatusAnimal($_GET["idAnimal"], $_GET["status"]);
                if (!empty($existeRegistro)) {
                    $daoLista->ApagarUsuariodaLista($_GET["idUsuario"], $_GET["idAnimal"]);
                } 
            } 
        } 
        header('Location:../View/sucesso.php');
    }
}

?>