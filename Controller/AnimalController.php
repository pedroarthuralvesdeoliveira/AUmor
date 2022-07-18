<?php

require_once('../Config/database.class.php');
require_once('../DAO/animaldao.class.php');

class AnimalController
{
    public function acessar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_SESSION['idUsuario'])) {
			return $dao->Acessar($animal);
		}
	}
	
	public function acessarAnimaisAtivos(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		return $dao->acessarAnimaisAtivos($animal);	
	}

	public function acessarAnimaisAtivosDeOutroUsuario(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_SESSION['idUsuario'])) {
			return $dao->acessarAnimaisAtivosDeOutroUsuario($animal);	
		}
	}

	public function acessarAnimaldoUsuario(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();

		if (isset($_SESSION['idUsuario']))
			return $dao->AcessarAnimaldoUsuario($animal);
	}

	public function acessarAnimaldoUsuarioParaEditar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);
		$animal = new Animal();
		
		if (isset($_GET['idUsuario']) && isset($_GET['idAnimal'])) {
			return $dao->AcessarAnimaldoUsuarioParaEditar($_GET['idUsuario'], $_GET['idAnimal']);
		}	
	}

    public function apagar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);

		if (isset($_GET["id"]) && isset($_GET["status"])) {
			$dao->Desativar($_GET["id"], $_GET["status"]);
		}
		
		header('Location:../View/listarAnimaldoUsuario.php');
	}

	public function buscarAnimal(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new AnimalDAO($db);

		if (isset($_GET["id"])) {
			return $dao->buscarAnimal($_GET["id"]);
		}
	}

    public function editar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

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

    public function editarFoto(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $db = new Database();
        $dao = new AnimalDAO($db);
        $animal = new Animal();

        $animal->setIdAnimal($_POST["idAnimal"]);

        $id = Date("YmdHms");
        $extensao = explode(".", $_FILES["imagem"]["name"]);
        $imagem = "foto".$id.".".$extensao[1];	

        $animal->setImagem($imagem);
        
        $dao->EditarFotoAnimal($animal);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);

        header("Location:../View/sucesso.php");
    }

    public function enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal){
        $to_email = $email;
        $subject = "AUmor! ;)";
        $body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." foi validado";
        $headers = "From: sender\'s email";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email enviado com sucesso para ".$to_email."";
        }
        echo "Falha no envio do email.";
    } 
    
    public function enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal){
        $to_email = $email;
        $subject = "AUmor! ;)";
        $body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." não foi aprovado! :(";
        $headers = "From: sender\'s email";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email enviado com sucesso para ".$to_email."";
        } 
        echo "Falha no envio do email.";
    }

	public function FiltrarAnimais($porte, $sexo, $tipo){
		try{
			$db = new Database();
			$dao = new AnimalDAO($db);
			$dao->FiltrarAnimais($porte, $sexo, $tipo);
		}catch (PDOException $e){
			echo "Erro: " . $e->getMessage();
		}
		return $dao;
	}

    public function inserir(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

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
		} 
		$Comportamento = $_POST["comportamento"];
		$textComportamento = implode(",", $Comportamento);
		$animal->setComportamento($textComportamento);
	
		if ($_POST["saude"] == "") {
			$textSaude = "Sem dados";
			$animal->setSaude($textSaude);
		} 
		$Saude = $_POST["saude"];
		$textSaude = implode(",", $Saude);
		$animal->setSaude($textSaude);

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

    public function permitir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $db = new Database();
        $daoUsuario = new UsuarioDAO($db);
        $dao = new AnimalDAO($db);
        
        if (isset($_GET["idAnimal"]) && isset($_GET["statusAprovacao"]) && isset($_GET["idUsuario"]) && isset($_GET['nomeAnimal']) ) {
            $nomeAnimal = $_GET['nomeAnimal'];
            $dao->alterarPermissao($_GET["idAnimal"], $_GET["statusAprovacao"]);
            $emailUsuario = $daoUsuario->buscarDonoAnimal($_GET["idAnimal"], $_GET["idUsuario"]);
            $email = $emailUsuario->email;

            if ($_GET["statusAprovacao"] == "1") {
                AnimalControllerPermissao::enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal);
            }
            AnimalControllerPermissao::enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal);
            header('Location:../View/listarAnimal.php');
        } 
    }
}

?>