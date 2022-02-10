<!doctype html>

<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container"> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar6"> <a class="navbar-brand text-primary d-none d-md-block" href="#">
      <i class="fas fa-paw txAzul fa-lg"></i>
         
        </a>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"> <a class="nav-link" href="index.html">Início</a> </li>
          <li class="nav-item"> <a class="nav-link" href="feedAnimais.php">Adote</a> </li>
          <li class="nav-item"> <a class="nav-link" href="sobreNos.php">Sobre nós</a> </li>
        </ul>
        <ul class="navbar-nav" >
        
        <?php
        

          
        if(isset($_SESSION['idUsuario'])){
          
              if ($_SESSION['tipoUser'] == 1){
                echo " <li class='nav-item'>  <a class='nav-link' href='perfilUsuario.php'> <img class='d-block rounded-circle mt-2 mb-0 mx-auto grow imagemcertinha' src='imagens/".$_SESSION['imagem']."' width='40' height='40'> </a> </li> ";
                

              }else{
                echo " <li class='nav-item'>  <a class='nav-link' href='perfilUsuario.php'> <img class='d-block rounded-circle mt-2 mb-0 mx-auto grow imagemcertinha' src='imagens/".$_SESSION['imagem']."' width='40' height='40'> </a> </li>";

              }
              echo " <li class='nav-item'> <a class='px-2 py-0 fas fa-sign-out-alt fa-lg p-1 txAzul my-3' href='../Controller/UsuarioControllerLogin.php?acao=sair'></a> </li>";
              }else{
                echo "<li class='nav-item'> <a class='nav-link' href='login.php'>Entrar</a> </li>";
                echo "<li class='nav-item'> <a class='nav-link' href='cadastrarUsuario.php' style='color:#82D1E2'>Cadastre-se</a> </li>";
            }

          ?>
        </ul>
      </div>
    </div>
  </nav>


</html>