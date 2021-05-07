<?php 

    require_once("../Config/database.class.php");
    require_once("../DAO/usuariodao.class.php");

    $db = new Database();
    $dao = new UsuarioDAO($db);
    $dao->validarEmail($_REQUEST["id"], $_REQUEST['email']);

    header("Location:http://localhost/ONG-AUmor/View/index.php");
    
?>