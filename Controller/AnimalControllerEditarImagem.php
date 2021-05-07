<?php 
	CLASS AnimalControllerEditarImagem{
		public static function editarFoto(){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			require_once('../Model/animal.class.php');
			require_once('../DAO/animaldao.class.php');
			require_once('../Config/database.class.php');

			$db = new Database();
			$dao = new AnimalDAO($db);
			$animal = new Animal();

            // $animal->setIdUsuario($_POST["idUsuario"]);
			$animal->setIdAnimal($_POST["idAnimal"]);

			$id = Date("YmdHms");
			$extensao = explode(".", $_FILES["imagem"]["name"]);
			$imagem = "foto".$id.".".$extensao[1];	

			$animal->setImagem($imagem);
			
			$dao->EditarFotoAnimal($animal);
			move_uploaded_file($_FILES["imagem"]["tmp_name"], "../View/imagens/".$imagem);

			header("Location:../View/sucesso.php");
		}
	}
	AnimalControllerEditarImagem::editarFoto();
?>