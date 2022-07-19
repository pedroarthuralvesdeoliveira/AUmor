<?php 

    CLASS AdocaoControllerDevolucao{
        public static function devolver(){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            require_once('../Model/adocao.class.php');
            require_once('../DAO/adocaodao.class.php');

            require_once('../Model/animal.class.php');
            require_once('../DAO/animaldao.class.php');

            require_once('../Config/database.class.php');

            $db = new Database();

            $adocao = new Adocao();
            $data = Date("Ymd");
            $adocao->setDataDevolucao($data);
            $dao = new AdocaoDAO($db);

            $daoAnimal = new AnimalDAO($db);

            if (isset($_GET["idAnimal"]) && isset($_GET["status"]) && isset($_GET["status"])) {
                $dao->devolucaoAnimal($_GET["idAnimal"], $_GET["status"], $adocao);
                $daoAnimal->alterarStatusAnimal($_GET["idAnimal"], $_GET["status"]);                
            }

            header('Location:../View/listarAnimaldoUsuario.php');

        }
    }
    AdocaoControllerDevolucao::devolver();
?>