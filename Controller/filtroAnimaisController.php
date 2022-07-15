<?php

$porte = false;

header('Content-type: text/html; charset=UTF-8');
if ((isset($_POST['porte'])) && (!empty($_POST['porte'])) && ($_POST['porte'] != 'todos')){
    $porte = $_POST['porte'];
}

$sexo = false;

if ((isset($_POST['sexo'])) && (!empty($_POST['sexo'])) && ($_POST['sexo'] != 'todos')){
    $sexo = $_POST['sexo'];
}

$tipo = false;

if ((isset($_POST['tipo'])) && (!empty($_POST['tipo'])) && ($_POST['tipo'] != 'todos')){
    $tipo = $_POST['tipo'];
}

require_once('AnimalControllerAcessar.php');

$animal = new AnimalControllerAcessar(); 
$acessarAnimais = $animal->FiltrarAnimais($porte, $sexo, $tipo);
$resultado = "";

if(!empty($acessarAnimais)){
    foreach($acessarAnimais as $acessarAnimal){
        $resultado .="
        <div class='col-lg-4 col-sm-4 col-6'>
          </br>
          
            <div class='hoverzoom''>
          
            <img class='imagemcertinha'src='imagens/".$acessarAnimal['imagem']."' width='100%'  height= '200px' >
                <div class='card-body mt-3 mb-0'> 
                    <div class='retina'>
                        <td><a href='perfilAnimal.php?id=".$acessarAnimal['idAnimal']."'>".$acessarAnimal['nome']."</a>
                    </div>
                </div>
              
            </div>

        </div>
        ";
    }
}
    echo json_encode($resultado);
    
?>