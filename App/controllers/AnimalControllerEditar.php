<?php
CLASS AnimalControllerEditar{
	public static function editar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');
		
		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();

		$animal->setIdUsuario($_POST["idUsuario"]);
		$animal->setIdAnimal($_POST["idAnimal"]);
		$animal->setNome($_POST["nome"]);
		$animal->setIdade($_POST["idade"]);
		$animal->setSexo($_POST["sexo"]);
		$animal->setTipo($_POST["tipo"]);
		$animal->setPorte($_POST["porte"]);
		
		$Comportamento = $_POST["comportamento"];
		$textComportamento = implode(",", $Comportamento);
		$animal->setComportamento($textComportamento);

		$Saude = $_POST["saude"];
		$textSaude = implode(",", $Saude);
		$animal->setSaude($textSaude);

		$animal->setMotivoAdocao($_POST["motivoAdocao"]);

		$dao->Editar($animal);

		header('Location:../View/sucesso.php');
	}
} 
AnimalControllerEditar::editar();
?>