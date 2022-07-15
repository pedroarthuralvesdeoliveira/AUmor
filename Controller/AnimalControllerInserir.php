<?php
session_start();
CLASS AnimalControllerInserir{
	public static function inserir(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once('../Model/animal.class.php');
		require_once('../DAO/animaldao.class.php');
		require_once('../Config/database.class.php');

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();

		require_once('UsuarioControllerAcessar.php');
		$dados = new UsuarioControllerAcessar();
		$usuario = $dados->acessar();

		$animal->setIdUsuario($usuario->idUsuario);
		$animal->setNome($_POST["nome"]);
		$animal->setIdade($_POST["idade"]);
		$animal->setPorte($_POST["porte"]);
		$animal->setSexo($_POST["sexo"]);

		if ($_POST["comportamento"] == ""){
			$textComportamento = "Sem dados";
			$animal->setComportamento($textComportamento);
		} else{
			$Comportamento = $_POST["comportamento"];
			$textComportamento = implode(",", $Comportamento);
			$animal->setComportamento($textComportamento);
		}
	
		if ($_POST["saude"] == "") {
			$textSaude = "Sem dados";
			$animal->setSaude($textSaude);
		} else{
			$Saude = $_POST["saude"];
			$textSaude = implode(",", $Saude);
			$animal->setSaude($textSaude);
		}

		//SE O USUÁRIO FOR ADM  NÃO PRECISA VALIDAR SEU PRÓPRIO ANIMAL
		if ($_SESSION['tipoUser'] == 1) {
			$statusAprovacao = 1;
		}

		$animal->setStatusAprovacao($statusAprovacao);
		$animal->setTipo($_POST["tipo"]);
		$animal->setMotivoAdocao($_POST["motivoAdocao"]);

		$id = Date("YmdHms");
		$extensao = explode(".", $_FILES["imagem"]["name"]);
		$imagem = "foto".$id.".".$extensao[1];

		$animal->setImagem($imagem);

		$dao->Inserir($animal);
		
		move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);
		header('Location:../View/sucesso.php');
	}
}
AnimalControllerInserir::inserir();
?>
