<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Perfil do Animal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  require_once('../Controller/AnimalControllerAcessar.php');
  require_once('../Controller/ListaInteresseControllerAcessar.php');
  require_once('../Controller/UsuarioControllerAcessar.php');
  require_once('../DAO/usuariodao.class.php');
  require_once('../Model/usuario.class.php');

  $db = new Database();
  $dao = new UsuarioDAO($db);

  $animalAcessar = new AnimalControllerAcessar();
  $dados = $animalAcessar->buscarAnimal();

  $objeto = new ListaInteresseControllerAcessar();
  $listaObjeto = $objeto->acessar();

  
?>
</head>


  <?php
    foreach ($dados as $animal) {
      $data = explode(" ", $animal['dataInscricao']);
      $soData = explode("-", $data[0]);
      $acessarUsuario = $dao->acessarNome($animal["idUsuario"]);
      
  ?>
    
<body class="pb-0">

    <?php 
      require_once('header.php');
      include 'menu.php';
    ?>
<div class="container wrapper my-3">


  <div class="px-5 py-4 mx-5" >
    <div class="container">
      <div class="row">
        <div class="px-5 col-md-8 text-center mx-auto">
          <h3 class="display-4 txAzul" > <b> <?php  echo $animal["nome"]?></b> </h3>
        </div>
      </div>
      <div class="row">
    
        <div class="col-md-12"> <img width="200" height="200" class="d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha" src="imagens/<?php echo $animal["imagem"]?>"> </div>
      </div>
    </div>
  </div>
  <div class="py-5 align-items-baseline">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <ul class="list-group list-group-flush font"></ul>

          <?php
             
            if ($animal["sexo"] == "femea") {
              $animal["sexo"] = "fêmea";
            }
            if ($animal["porte"] == "medio") {
              $animal["porte"] = "médio";
            }
          
          ?>
          
            <li class="list-group-item"><i class="far fa-calendar-alt txAzul mr-2"></i><b class="fontWeight txAzul">Data de Inscrição:</b> <b class="fontWeight"> <?php  echo " ".$soData[2]."/".$soData[1]."/".$soData[0]."";?> </b></li> 
            <li class="list-group-item"><i class="fas fa-venus-mars txAzul mr-2"></i><b class="fontWeight txAzul">Sexo: </b>                <b class="fontWeight"><?php  echo $animal["sexo"]?> </b></li>
            <li class="list-group-item"><i class="fas fa-tape txAzul mr-2"></i> <b class="fontWeight txAzul">Porte: </b>                    <b class="fontWeight"><?php  echo $animal["porte"]?></b></li>
            <li class="list-group-item"><i class="fas fa-birthday-cake txAzul mr-2"></i><b class="fontWeight txAzul">Idade aproximada: </b> <b class="fontWeight"><?php  echo $animal["idade"]?></b></li>
            <li class="list-group-item"><i class="fas fa-notes-medical txAzul mr-2"></i><b class="fontWeight txAzul">Saúde: </b>            <b class="fontWeight"><?php  echo $animal["saude"]?></b></li>    
            <li class="list-group-item"><i class="fas fa-paw txAzul mr-2"></i> <b class="fontWeight txAzul">Comportamento: </b>             <b class="fontWeight"><?php  echo $animal["comportamento"]?></b></li>
            <li class="list-group-item"><i class="far fa-file-alt txAzul mr-2"></i> <b class="fontWeight txAzul">Motivo de adoção: </b>     <b class="fontWeight"><?php  echo $animal["motivoAdocao"]?></b></li>
            
            <?php 
            
             if($animal["tipo"] == "cachorro")
              echo"<li class='list-group-item fontWeight txAzul '><i class='fas fa-dog txAzul mr-2'></i> <b class='txAzul'> Cachorro </li> </b>";
            else {
              echo"<li class='list-group-item'><i class='fas fa-cat txAzul mr-2'></i> <b class='txAzul'> Gato </li> </b>";
              }
            ?>
          </ul>
        </div>
        <div class="col-md-6">
        <p class="fontWeight"> Cadastrado por  <?php  echo $acessarUsuario["nome"]; ?> </p>
          

          <?php
            if ($animal["statusAdocao"] == 0) {
                echo " <h3 class='fontWeight txAzul'> Não adotado </h3>";
            }else {
                echo " <h3 class='fontWeight txAzul'> Adotado </h3>";
            } 
          ?>
          <br>
          
          
          </p>

          <!-- Tratamento do botão adotar -->
            <?php 
              $EstaLista = 0;
              foreach($listaObjeto as $lista){
                if(isset($_SESSION['idUsuario'])){
                  if ($lista["idUsuario"] == $_SESSION['idUsuario'] && $lista["idAnimal"] == $animal['idAnimal']) {
                    $EstaLista = 1;
                  }
                }
              }

              if (isset($_SESSION['idUsuario'])) {
                
                if ($_SESSION['idUsuario'] != $animal['idUsuario']) {
                  
                  if ($_SESSION['statusValidacao'] == 0) { 
                    echo "<a class='btn bgAzul mt-5 mb-0 px-5 but' data-bs-toggle='modal' data-bs-target='#modalEmail'> Adotar </a>";
                  } else{
                    if ($EstaLista == 1) {
                      echo "<p mt-5 mb-0 px-5> Você já esta na lista de interesse desse animal </p>";
                      
                    } else{
                      if ($animal["statusAdocao"] == 1){
                        echo "";
                      }else{
                         echo "<a class='btn bgAzul mt-5 mb-0 px-5 but' data-bs-toggle='modal' data-bs-target='#modalCerteza'> Adotar </a>";
                      }
                    }
                  }

                } else {
                 echo "Animal cadastrado por você";
                }
 
              } else{
                echo "<a class='btn bgAzul mt-5 mb-0 px-5 but' href='login.php'>Adotar</a>";
              }     

            ?> 
            <!-- FIM DO TRATAMENTO DO BOTÃO -->
            
             <button type="button" class="btn btn-outline-primary mt-5 px-5" onClick="history.go(-1)">Voltar</button></a>
        </div>
      </div>
    </div> 


    
    
  </div>    

    <!-- Modal -->
      <div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Valide seu Email</h5>
            <button data-bs-dismiss="modal" class="btn btn-outline-primary" > x </button>
          </div>
          <div class="modal-body">
            Valide seu email para adotar um animal
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCerteza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja continuar?</h5>
            
          </div>
          <div class="modal-body">
            Para adotar esse animal você entrará em uma lista de interessados. O protetor desse animal terá acesso a seus dados particulares (telefone e email) para contato. Tem certeza que deseja continuar? 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

            <?php echo "<a class='btn bgAzul but' href='../Controller/ListaInteresseControllerInserir.php?idUsuario=".$_SESSION['idUsuario']."&idAnimal=".$animal['idAnimal']."'>Confirmar</a>";?>  
          </div>
        </div>
      </div>
    </div>
     
  
   </body>
  <?php  }?>

<?php  include 'footer.php'; ?>
</html>