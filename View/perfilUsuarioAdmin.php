<?php 

session_start();

require_once("../Controller/UsuarioControllerAcessar.php");
$dados = new UsuarioControllerAcessar();
$usuario = $dados->acessar(); 
if(empty($usuario)){
  header('Location:login.php');
}


// if($_SESSION['statusValidacao'] != 1){
//   // echo "seu safadinho";
//   header('Location:login.php');
// }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  
  <title>Perfil do Usuário Administrador</title>
</head>

<body >
<?php require_once('header.php'); ?>  
<?php  include 'menu.php'; ?>  



    <div class="container ">
      <div class="container" style=""><h1 class="m-3 txAzul d-flex justify-content-center fontWeight" style="white-space: nowrap; align:center">Seja bem-vindo(a), <?php echo $usuario->nome  ?></h1></div>
    </div>
 

  <div class="container wrapper my-3 p-2">
  
  <div>
      <div class="row m-2 fontSize">
          <div class="col-lg-4 order-2 order-lg-1">
          <img class="d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha" src="imagens/<?php echo $usuario->imagem ?>" width="200"  height="200">
          </div>
          <div class="col-lg-4 d-flex flex-column justify-content-center order-1 order-lg-2">
            <h3 class="fontWeight txAzul">Informações</h3>
            <p class="mb-3 "><?php echo $usuario-> nome." ".$usuario->sobrenome  ?><br><?php echo $usuario->telefone  ?><br><?php echo $usuario->email  ?></p>
            <p class="mb-3" > <?php echo $usuario->descricao  ?> </p>
          </div>
          
          <div class="px-5 col-lg-4 d-flex order-1 order-lg-2 flex-row justify-content-end align-items-end">
            <a class="grow" href="editarUsuario.php"> <i class="fas fa-edit txAzul"></i>
          </div></a>
        </div>
    </div>
    <div class=" container px-4 py-5">
     
          <div class="row">
        <!-- Fazer com que o sistema mande outro email para o usuário   -->
          <?php 
            if ($_SESSION['statusValidacao'] != 1) {
              echo "<div class='col-md'> <button type='button' class='btn text-white btn-lg btn-block bgAzul butHover' data-bs-toggle='modal' data-bs-target='#modalEmail'> Cadastrar</button></div>";        
            } else {
              echo "<div class='col-md'><a class='btn text-white btn-lg btn-block bgAzul butHover' href='cadastrarAnimal.php'>Cadastrar</a></div>";
            }
          ?>
            <div class="col-md"><a class="btn text-white btn-lg btn-block bgAzul butHover" href="feedAnimais.php">Adotar</a></div>
            <!-- <div class="col-md-4"><a class="btn btn-primary btn-lg btn-block bgAzul" href="usuarioAnimaisInteressados.php">Animais que você tem interesse:</a></div> -->
            <div class="col-md"><a class="btn text-white btn-lg btn-block bgAzul butHover" href="listarAnimaldoUsuario.php">Seus animais</a></div>
            <?php 
              echo "<div class='col-md'><a class='btn text-white btn-lg btn-block bgAzul butHover ' href='usuarioAnimaisInteressados.php?idUsuario=".$usuario->idUsuario."'> Seus interesses</a></div>
              "; 
            ?>
             <div class="col-md"><a class="btn text-white btn-lg btn-block bgAzul butHover" href="listarAnimal.php">Aprovações</a></div>
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
            Valide seu email para cadastrar um animal
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
  

</body>
<?php include 'footer.php'; ?> 
</html>