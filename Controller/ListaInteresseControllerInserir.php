<?php
    session_start();
    CLASS ListaInteresseControllerInserir{
        public static function inserir(){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            require_once('../Model/listaInteresse.class.php');
            require_once('../DAO/listaInteressedao.class.php');
            require_once('../Config/database.class.php');
            
            $db = new Database();
            $dao = new ListaInteresseDAO($db);

            if(empty($_SESSION['idUsuario'])) {
                header('Location:../View/login.php');
            } else {        
                if ($_SESSION['statusValidacao'] == 0){
                    echo "valide seu email para realizar a adoção";
                } else {
                    if(isset($_GET['idUsuario']) && isset($_GET['idAnimal'])){
                        $dao->AdicionarUsuarioEmListaInteresse($_GET['idUsuario'], $_GET['idAnimal']);
                        header('Location:../View/usuarioAnimaisInteressados.php?idUsuario='.$_GET['idUsuario']);
                    }
                }
            }
        }
    }
    ListaInteresseControllerInserir::inserir();
?>




