<?php

CLASS AnimalControllerAcessar{
	public static function acessar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_SESSION['idUsuario'])) {
			return $dao->Acessar($animal);
		}
	}
	
	public static function acessarAnimaisAtivos(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		return $dao->acessarAnimaisAtivos($animal);	
	}

	public static function acessarAnimaisAtivosDeOutroUsuario(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_SESSION['idUsuario'])) {
			return $dao->acessarAnimaisAtivosDeOutroUsuario($animal);	
		}
	}

	public static function acessarAnimaldoUsuario(){

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();

		if (isset($_SESSION['idUsuario']))
			return $dao->AcessarAnimaldoUsuario($animal);
	}

	public static function acessarAnimaldoUsuarioParaEditar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_GET['idUsuario']) && isset($_GET['idAnimal'])) {
			return $dao->AcessarAnimaldoUsuarioParaEditar($_GET['idUsuario'], $_GET['idAnimal']);
		}	
	}

	public static function buscarAnimal(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);

		if (isset($_GET["id"])) {
			return $dao->buscarAnimal($_GET["id"]);
		}
	}

	public function FiltrarAnimais($porte, $sexo, $tipo){
		
		require_once('../Config/database.class.php');
		$db = new Database();

		try{
			$resultado = array();
			$sql = "SELECT * FROM animal WHERE StatusDesativar = 0 AND  StatusAprovacao = 1";
			if ($porte){
				$sql .= " AND porte = '" . $porte . "'";
			}
			if ($sexo){
				$sql .= " AND sexo = '" . $sexo . "'";
			}
			if ($tipo){
				$sql .= " AND tipo = '" . $tipo . "'";
			}
			$stmt = $db->getConnection()->prepare($sql);

			$stmt->execute();

			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$resultado = $stmt->fetchAll();
		}catch (PDOException $e){
			echo "Erro: " . $e->getMessage();
		}
		return $resultado;
	}
}
AnimalControllerAcessar::acessar();
AnimalControllerAcessar::acessarAnimaisAtivos();
AnimalControllerAcessar::acessarAnimaisAtivosDeOutroUsuario();
AnimalControllerAcessar::acessarAnimaldoUsuario();
AnimalControllerAcessar::acessarAnimaldoUsuarioParaEditar();
AnimalControllerAcessar::buscarAnimal();
?>

