<?php

namespace App\Controllers;

class AnimalController
{
	private $database;
	private $animal;
	private $animalDAO;
	
	public function __construct(\Config\Database $database, \App\Models\Animal $animal, \Dao\AnimalDAO $animalDAO)
	{
		$this->database = $database;
		$this->animal = $animal;
		$this->animalDAO = $animalDAO;
	}

    public function acessar()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		if (isset($_SESSION['idUsuario'])) {
			return $this->animalDAO->Acessar($this->animal);
		}
	}
	
	public function acessarAnimaisAtivos()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		return $this->animalDAO->acessarAnimaisAtivos($this->animal);	
	}

	public function acessarAnimaisAtivosDeOutroUsuario(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		if (isset($_SESSION['idUsuario'])) {
			return $this->animalDAO->acessarAnimaisAtivosDeOutroUsuario($this->animal);	
		}
	}

	public function acessarAnimaldoUsuario()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AnimalDAO($this->database);
		$animal = new \App\Models\Animal();
		if (isset($_SESSION['idUsuario']))
			return $dao->AcessarAnimaldoUsuario($animal);
	}

	public function acessarAnimaldoUsuarioParaEditar()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AnimalDAO($this->database);
		
		if (isset($_GET['idUsuario']) && isset($_GET['idAnimal'])) {
			return $dao->AcessarAnimaldoUsuarioParaEditar($_GET['idUsuario'], $_GET['idAnimal']);
		}	
	}

    public function apagar()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AnimalDAO($this->database);
		if (isset($_GET["id"]) && isset($_GET["status"])) {
			$dao->Desativar($_GET["id"], $_GET["status"]);
		}
		header('Location:../View/listarAnimaldoUsuario.php');
	}

	public function buscarAnimal()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$dao = new \DAO\AnimalDAO($this->database);
		if (isset($_GET["id"])) {
			return $dao->buscarAnimal($_GET["id"]);
		}
	}

    public function editar()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$dao = new \DAO\AnimalDAO($this->database);
		$animal = new \App\Models\Animal();

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

    public function editarFoto()
	{
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $dao = new \DAO\AnimalDAO($this->database);
        $animal = new \App\Models\Animal();
        $animal->setIdAnimal($_POST["idAnimal"]);
        $id = Date("YmdHms");
        $extensao = explode(".", $_FILES["imagem"]["name"]);
        $imagem = "foto".$id.".".$extensao[1];	
        $animal->setImagem($imagem);
        $dao->EditarFotoAnimal($animal);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);
        header("Location:../View/sucesso.php");
    }

    public function enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal)
	{
        $to_email = $email;
        $subject = "AUmor! ;)";
        $body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." foi validado";
        $headers = "From: sender\'s email";
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email enviado com sucesso para ".$to_email."";
        }
        echo "Falha no envio do email.";
    } 
    
    public function enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal)
	{
        $to_email = $email;
        $subject = "AUmor! ;)";
        $body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." não foi aprovado! :(";
        $headers = "From: sender\'s email";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email enviado com sucesso para ".$to_email."";
        } 
        echo "Falha no envio do email.";
    }

	public function filtrarAnimais($porte, $sexo, $tipo)
	{
		try
		{
			$dao = new \DAO\AnimalDAO($this->database);
			$dao->FiltrarAnimais($porte, $sexo, $tipo);
		}
		catch (\PDOException $e)
		{
			echo "Erro: " . $e->getMessage();
		}
		return $dao;
	}

    public function inserir()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$usuarioController = new \App\Controllers\UsuarioController();
		$usuario = $usuarioController->acessar();

		$this->animal->setIdUsuario($usuario->idUsuario);
		$this->animal->setNome($_POST["nome"]);
		$this->animal->setIdade($_POST["idade"]);
		$this->animal->setPorte($_POST["porte"]);
		$this->animal->setSexo($_POST["sexo"]);

		if ($_POST["comportamento"] == ""){
			$textComportamento = "Sem dados";
			$this->animal->setComportamento($textComportamento);
		} 
		$comportamento = $_POST["comportamento"];
		$textComportamento = implode(",", $comportamento);
		$this->animal->setComportamento($textComportamento);
	
		if ($_POST["saude"] == "") {
			$textSaude = "Sem dados";
			$this->animal->setSaude($textSaude);
		} 
		$saude = $_POST["saude"];
		$textSaude = implode(",", $saude);
		$this->animal->setSaude($textSaude);

		//SE O USUÁRIO FOR DO TIPO ADM  NÃO PRECISARÁ VALIDAR O SEU PRÓPRIO ANIMAL
		if ($_SESSION['tipoUser'] == 1) {
			$statusAprovacao = 1;
		}

		$this->animal->setStatusAprovacao($statusAprovacao);
		$this->animal->setTipo($_POST["tipo"]);
		$this->animal->setMotivoAdocao($_POST["motivoAdocao"]);

		$id = Date("YmdHms");
		$extensao = explode(".", $_FILES["imagem"]["name"]);
		$imagem = "foto".$id.".".$extensao[1];

		$this->animal->setImagem($imagem);

		$this->animalDAO->Inserir($this->animal);
		
		move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);
		header('Location:../View/sucesso.php');
	}

    public function permitir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $usuarioDAO = new \DAO\UsuarioDAO($this->database);
        $animalDAO = $this->animalDAO->$this->database;
        
        if (isset($_GET["idAnimal"]) && isset($_GET["statusAprovacao"]) && isset($_GET["idUsuario"]) && isset($_GET['nomeAnimal']) ) {
            $nomeAnimal = $_GET['nomeAnimal'];
            $animalDAO->alterarPermissao($_GET["idAnimal"], $_GET["statusAprovacao"]);
            $emailUsuario = $usuarioDAO->buscarDonoAnimal($_GET["idAnimal"], $_GET["idUsuario"]);
            $email = $emailUsuario->email;

            if ($_GET["statusAprovacao"] == "1") {
                $this->enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal);
            }
            $this->enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal);
            header('Location:../View/listarAnimal.php');
        } 
    }
}

?>