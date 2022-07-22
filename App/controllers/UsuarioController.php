<?php

session_start();
require_once('../Config/database.class.php');
require_once('../Model/usuario.class.php');
require_once('../DAO/usuariodao.class.php');

class UsuarioController
{
    public function acessar(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $db = new Database();
        $dao = new UsuarioDAO($db);
        $usuario = new Usuario();

        if (isset($_SESSION['idUsuario'])){
            return $dao->Acessar($usuario);
        }
    }

    public function acessarParaEditarAnimal(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $db = new Database();
        $dao = new UsuarioDAO($db);
        $usuario = new Usuario();

        if (isset($_GET['idUsuario'])){
            return $dao->Acessar($usuario);
        }
    }

    public function apagar(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$db = new Database();
		$dao = new UsuarioDAO($db);
		
		if (isset($_GET["id"])) {
			$dao->Desativar($_GET["id"]);
		}
	}

    public function editar(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('EnderecoControllerEditar.php');

        $db = new Database();
        $dao = new UsuarioDAO($db);
        $usuario = new Usuario();

        $usuario->setIdUsuario($_POST["idUsuario"]);
        $usuario->setNome($_POST["nome"]);
        $usuario->setSobrenome($_POST["sobrenome"]);
        $usuario->setTelefone($_POST["telefone"]);
        $usuario->setDescricao($_POST["descricao"]);

        $dao->Editar($usuario);
        header("Location:../View/sucesso.php");
    }

    public function editarFoto(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $db = new Database();
        $dao = new UsuarioDAO($db);
        $usuario = new Usuario();

        $usuario->setIdUsuario($_POST["idUsuario"]);

        $id = Date("YmdHms");
        $extensao = explode(".", $_FILES["imagem"]["name"]);
        $imagem = "foto".$id.".".$extensao[1];	

        $usuario->setImagem($imagem);
        
        $dao->EditarFoto($usuario);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);

        header("Location:../View/editarFotoUsuario.php");
    }

    public function enviarEmail($id, $email){
			
        $to_email = $email;
        $subject = "Validação da sua conta na AUmor! ;)";
        $body = "Olá! Por favor, valide seu email!";
        $body.= "<br><button><a href='http://localhost/ONG-AUmor/Controller/UsuarioControllerValidacao.php?id=".$id."&email=".$email.">Clique aqui para validar seu e-mail</a></button>";
        $headers = "From: AUmor\'s email";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email enviado com sucesso para ".$to_email."";
        } 
            echo "Falha no envio do email.";
    }

    public function inserir() 
    {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		require_once('enderecoControllerInserir.php');

		$db = new Database();
			
		$dao = new UsuarioDAO($db);
		$usuario = new Usuario();

		$usuario->setNome($_POST["nome"]);
		$usuario->setSobrenome($_POST["sobrenome"]);
		$usuario->setRg($_POST["rg"]);
		$usuario->setDataNasc($_POST["dataNasc"]);
		$usuario->setTelefone($_POST["telefone"]);
		$usuario->setEmail($_POST["email"]);
		$email = $usuario->getEmail();
		$usuario->setSenha(md5($_POST["senha"]));
		$usuario->setDescricao($_POST["descricao"]);

		$emailVerifica = $dao->verificaEmail($_POST["email"]);
		$rg = $dao->verificaRg($_POST["rg"]);

		if ($_FILES["imagem"]["size"]>0) 
		{
			$idImagem = Date("YmdHms");
			$extensao = explode(".", $_FILES["imagem"]["name"]);
			$imagem = "foto".$idImagem.".".$extensao[1];
			move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);
			$usuario->setImagem($imagem);
		}

		$oldDados = array(
			"nome" => $usuario->getNome(),
			"sobrenome" => $usuario->getSobrenome(),
			"rg" => $usuario->getRg(),
			"telefone" => $usuario->getTelefone(),
			"email" => $usuario->getEmail(),
			"descricao" => $usuario->getDescricao()
		);

		if ($emailVerifica) 
		{
			$_SESSION['old'] = $oldDados;
			echo "Opa, parece que já existe um e-mail como o seu! :(";
			header("Location:../View/cadastrarUsuario.php?&e=1");
		}

		if ($rg)  
		{
			$_SESSION['old'] = $oldDados;
			echo "Opa, parece que já existe um rg como o seu! :(";
			header("Location:../View/cadastrarUsuario.php?&e=2");
		}
			
		unset($_SESSION['old']);
		$id = $dao->Inserir($usuario);
		header("Location:../View/sucessoCadastro.php");
		$this->enviarEmail($id, $email);	
	}

    public function login(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL); 
        $db = new Database();
        $dao = new UsuarioDAO($db);

        $usuario = new Usuario();

        if ($_GET['acao'] == "sair") 
        {
            session_reset();
            session_destroy();
            header('Location:../View/index.php');
        }  
        
        if ($_POST) 
        {
            $usuario->setEmail(addslashes($_POST["email"]));
            $usuario->setSenha(addslashes(md5($_POST["senha"]))); 
        }
        
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["senha"])) { 
            $dao->Login($usuario);
        }            
    }

    public function validacao()
    {
        $db = new Database();
        $dao = new UsuarioDAO($db);
        $dao->validarEmail($_REQUEST["id"], $_REQUEST['email']);

        header("Location:http://localhost/ONG-AUmor/View/index.php");
    }
    
    public function verificarLogin(){
        return false;
    
        if(isset($_SESSION['idUsuario'])){
            return true;
        }
    }
}

?>