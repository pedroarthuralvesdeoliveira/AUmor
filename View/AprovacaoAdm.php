<!DOCTYPE html>
<html>
<head>
	<title>Aprovar ou desaprovar animal</title> 

    <?php
    session_start();
    
    require_once('../Controller/AnimalControllerAcessar.php');
    require_once('../Controller/UsuarioControllerAcessar.php');

    $dados = new UsuarioControllerAcessar();
    $usuario = $dados->acessar(); 

    $animalAcessar = new AnimalControllerAcessar();
    $dadosAnimal = $animalAcessar->buscarAnimal();

    if (empty($usuario)) {
      header('Location:login.php');
    }
?>


</head>
<body>

<?php require_once('header.php'); ?>
<?php include 'menu.php'; ?>


<div class="container wrapper py-5 my-5">

<?php


    for ($i=0; $i < count($dadosAnimal); $i++) {

        echo "<h4 class='py-4 text-center'> Deseja aprovar ou desaprovar ".$dadosAnimal[$i]["nome"]."?</h4>";
        echo "<div class='d-flex justify-content-center'>";
        echo "<div class='mx-1'> <a href='../Controller/AnimalControllerPermissao.php?idAnimal=".$dadosAnimal[$i]['idAnimal']."&statusAprovacao=1&idUsuario=".$dadosAnimal[$i]['idUsuario']."&nomeAnimal=".$dadosAnimal[$i]["nome"]."'><button type='button' class='btn btn-primary'>Aprovar </button></a> </div>";
        echo "<div class='mx-1'> <a href='../Controller/AnimalControllerPermissao.php?idAnimal=".$dadosAnimal[$i]['idAnimal']."&statusAprovacao=0&idUsuario=".$dadosAnimal[$i]['idUsuario']."&nomeAnimal=".$dadosAnimal[$i]["nome"]."'><button type='button' class='btn btn-danger'>Desaprovar </button></a> </div>";
        echo "</div>";
    }
    ?>
</div>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-outline-primary  " onClick="history.go(-1)"> Voltar </button> 
    </div>
</body>
</html>