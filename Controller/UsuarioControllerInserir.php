<?php
session_start();
	CLASS UsuarioControllerInserir{
		public static function inserir(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		
			require_once('enderecoControllerInserir.php');

			require_once('../Model/usuario.class.php');
			require_once('../DAO/usuariodao.class.php');
			require_once('../Config/database.class.php');

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

			if ($_FILES["imagem"]["size"]>0){
			$idImagem = Date("YmdHms");
			$extensao = explode(".", $_FILES["imagem"]["name"]);
			$imagem = "foto".$idImagem.".".$extensao[1];
			move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);
			// header("Location:../View/sucesso.php");

			$usuario->setImagem($imagem);
		}else{
			$imagem = "imagem";
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
			if ($emailVerifica) {
				$_SESSION['old'] = $oldDados;
				echo "Opa, parece que já existe um e-mail como o seu! :(";
				header("Location:../View/cadastrarUsuario.php?&e=1");
			}else if ($rg) {
				$_SESSION['old'] = $oldDados;
				echo "Opa, parece que já existe um rg como o seu! :(";
				header("Location:../View/cadastrarUsuario.php?&e=2");
			}else{
				unset($_SESSION['old']);
				$id = $dao->Inserir($usuario);
				header("Location:../View/sucessoCadastro.php");
				UsuarioControllerInserir::enviarEmail($id, $email);	
			}
			
		}

		public static function enviarEmail($id, $email){
			
			$to_email = $email;
			$subject = "Validação da sua conta na AUmor! ;)";
			$body = "Olá! Por favor, valide seu email!";
			$body.= "<br><button><a href='http://localhost/ONG-AUmor/Controller/UsuarioControllerValidacao.php?id=".$id."&email=".$email.">Clique aqui para validar seu e-mail</a></button>";
			// $headers  = 'MIME-Version: 1.0' . "\r\n";
   			// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers = "From: AUmor\'s email";
			
			if (mail($to_email, $subject, $body, $headers)) {
				echo "Email enviado com sucesso para ".$to_email."";
			} else {
				echo "Falha no envio do email.";
			}
		}
	}
	UsuarioControllerInserir::inserir();
?>