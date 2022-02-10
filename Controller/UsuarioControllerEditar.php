<?php
	CLASS UsuarioControllerEditar{
		public static function editar(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once('EnderecoControllerEditar.php');

			require_once('../Model/usuario.class.php');
			require_once('../DAO/usuariodao.class.php');
			require_once('../Config/database.class.php');

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
	}
	UsuarioControllerEditar::editar();
?>
<!-- https://pt.stackoverflow.com/questions/16769/usar-fun%C3%A7%C3%A3o-de-uma-classe-dentro-de-outra-classe-php -->