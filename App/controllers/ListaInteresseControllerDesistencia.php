<?php 

CLASS ListaInteresseControllerDesistencia{
    public static function desistir(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once('../DAO/listaInteressedao.class.php');
        require_once('../Config/database.class.php');
        $db = new Database();
        $lista = new ListaInteresseDAO($db);

        $lista->ApagarUsuariodaLista($_GET["idUsuario"], $_GET["idAnimal"]);

        header('Location:../View/usuarioAnimaisInteressados.php?idUsuario='.$_GET["idUsuario"]);
    }
}

ListaInteresseControllerDesistencia::desistir();

?>