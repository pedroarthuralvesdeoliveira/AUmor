<?php 
	CLASS UsuarioControllerEditarImagem{
		public static function editarFoto(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once('../Model/usuario.class.php');
			require_once('../DAO/usuariodao.class.php');
			require_once('../Config/database.class.php');

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
	}
	UsuarioControllerEditarImagem::editarFoto();
?>