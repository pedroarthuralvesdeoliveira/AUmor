<?php
    CLASS ListaInteresseControllerPermissao{
        public static function permitir(){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            require_once('../Model/adocao.class.php');
            require_once('../DAO/adocaodao.class.php');

            require_once('../Model/animal.class.php');
            require_once('../DAO/animaldao.class.php');

            require_once('../Model/listaInteresse.class.php');
            require_once('../DAO/listaInteressedao.class.php');

            require_once('../Config/database.class.php');

            $db = new Database();

            $dao = new AdocaoDAO($db);

            $daoLista = new ListaInteresseDAO($db);

            $daoAnimal = new AnimalDAO($db);

            if (isset($_GET["idUsuario"]) && isset($_GET["idAnimal"]) && isset($_GET["status"])) {

                $adocaoExiste = $dao->buscarAdocao($_GET["idUsuario"], $_GET["idAnimal"]);
                $existeRegistro = $daoLista->buscarUsuarioAnimalLista($_GET["idUsuario"], $_GET["idAnimal"]);

                if (empty($adocaoExiste)) {
                    $dao->Inserir($_GET["idUsuario"], $_GET["idAnimal"]);
                    $daoAnimal->alterarStatusAnimal($_GET["idAnimal"], $_GET["status"]);
                    if (empty($existeRegistro)) {
                        //$dao->AdicionarUsuarioEmListaInteresse($_GET['idUsuario'], $_GET['idAnimal']);
                    } else {
                        $daoLista->ApagarUsuariodaLista($_GET["idUsuario"], $_GET["idAnimal"]);
                    }
                } 

            } 
            header('Location:../View/sucesso.php');
        }
    }
    ListaInteresseControllerPermissao::permitir();
?>
