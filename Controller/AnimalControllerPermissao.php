<?php
    CLASS AnimalControllerPermissao{
        public static function permitir(){

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
    
            // require_once('../Model/animal.class.php');
            require_once('../Model/usuario.class.php');
            require_once('../DAO/usuariodao.class.php');
            require_once('../DAO/animaldao.class.php');
            require_once('../Config/database.class.php');
    
            $db = new Database();
            $daoUsuario = new UsuarioDAO($db);
            $dao = new AnimalDAO($db);
            // $animal = new Animal();
            
            if (isset($_GET["idAnimal"]) && isset($_GET["statusAprovacao"]) && isset($_GET["idUsuario"]) && isset($_GET['nomeAnimal']) ) {
                $nomeAnimal = $_GET['nomeAnimal'];
                $dao->alterarPermissao($_GET["idAnimal"], $_GET["statusAprovacao"]);
                $emailUsuario = $daoUsuario->buscarDonoAnimal($_GET["idAnimal"], $_GET["idUsuario"]);
                // var_dump($emailUsuario->email);
                $email = $emailUsuario->email;

                if ($_GET["statusAprovacao"] == "1") {
                    AnimalControllerPermissao::enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal);
                } else {
                    AnimalControllerPermissao::enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal);
                }
                header('Location:../View/listarAnimal.php');
            } 
        }

        public static function enviarEmailDeAprovacaoDoAnimal($email, $nomeAnimal){
			$to_email = $email;
			$subject = "AUmor! ;)";
			$body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." foi validado";
			$headers = "From: sender\'s email";
			
			if (mail($to_email, $subject, $body, $headers)) {
				echo "Email enviado com sucesso para ".$to_email."";
			} else {
				echo "Falha no envio do email.";
			}
        } 
        
        public static function enviarEmailDeDesaprovacaoDoAnimal($email, $nomeAnimal){
            $to_email = $email;
			$subject = "AUmor! ;)";
			$body = "Olá! Gostaríamos de lhe avisar que seu animal ".$nomeAnimal." não foi aprovado! :(";
			$headers = "From: sender\'s email";
			
			if (mail($to_email, $subject, $body, $headers)) {
				echo "Email enviado com sucesso para ".$to_email."";
			} else {
				echo "Falha no envio do email.";
			}
        }
    }
    AnimalControllerPermissao::permitir();
?>