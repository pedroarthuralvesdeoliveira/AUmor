<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="main.js"></script>
  <title>Cadastro</title>

  <style>
    p {
      color: #ea6153;
      display: none
    }

    input:invalid+p {
      display: inline
    }
  </style>

</head>

<body>
<?php require_once('header.php');
include 'menu.php';

  if(isset($_GET['e'])){
    if($_GET['e']==1){
    echo "<script>alert('Seu e-mail já esta cadastrado!')</script>";
  }else if($_GET['e']==2){
    echo "<script>alert('Seu rg já esta cadastrado!')</script>";
  }
}
?>


  <div class="py-5 text-center">
    <div class="container wrapper">
      <div class="row">
        <div class="mx-auto col-lg-6 col-10">

          <div class="py-5 text-center">
            <div class="d-block mx-auto mb-4" alt="" width="72" height="57">
              <i class="fas fa-paw fa-3x"></i>
            </div>
            <h2>Cadastre-se aqui!</h2>

            <span class="text-muted"> * Campos obrigatórios </span>

          </div>


          <form class="text-left" enctype="multipart/form-data" action="../Controller/UsuarioControllerInserir.php" id="formulario" name="formulario" method="POST">

            <div class="row">

              <div class="form-group col-md-6"> <label for="form16">Nome*</label> 
              <input type="text" class="form-control" name="nome" maxlength="50" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['nome'] : '';?>" placeholder="Nome"> </div>
              <div class="form-group col-md-6"> <label>Sobrenome*</label> 
              <input type="text" class="form-control" name="sobrenome" maxlength="50" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['sobrenome'] : '';?>" placeholder="Sobrenome"></div>

            </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <label>RG* </label><span class="text-muted"> somente números </span>
                <input type="text" class="form-control" name="rg" maxlength="9" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['rg'] : '';?>" pattern='\d*'>
                <p>Ei! Este campo só pode ter números.</p>
              </div>
              <div class="form-group col-sm-6">
                <label>Telefone*</label> <span class="text-muted"> com DDD </span>
                <input type="text" class="form-control" name="telefone" id="telefone" maxlength="15" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['telefone'] : '';?>" onkeypress="mascaraTelefone(this)">
              </div>

            </div>

            <div class="row">

              <div class="form-group col-sm-12">
                <label>Data de Nascimento*</label>
                <input type="date" class="form-control" name="nascimento" id="nascimento">
              </div>
            </div>

            <hr class="my-4">
            <div class="row">

              <div class="form-group col">
                <label>Email*</label>
                <input type="email" class="form-control" name="email" maxlength="50" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['email'] : '';?>" placeholder="you@example.com">
              </div>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6"><label>Senha*</label> <input type="password" class="form-control" name="senha" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <p>A senha deve conter 8 ou mais caracteres com pelo menos um número e uma letra maiúscula</p>
              </div>
              <div class="form-group col-md-6"> <label> Confirmar Senha*</label><input type="password" class="form-control" name="confirm_senha" maxlength="50" id="confirm_senha"></div>

            </div>

            <div class="form-group">
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Imagem</label>
                <input type="file" class="form-control" id="inputGroupFile01" name="imagem">
              </div>

            </div>

            <hr class="my-4">

            <!-- Endereço começa aqui -->
            <div class="form-row">

              <div class="form-group col-md-6">
                <label>CEP*</label> <span class="text-muted"> somente números </span>
                <input type="text" class="form-control" name="cep" maxlength="9" onkeypress="mascaraCep(this)">
              </div>
              <div class="form-group col-md-6">
                <label>Bairro*</label>
                <input type="text" class="form-control" name="bairro" maxlength="50">
              </div>

            </div>

            <div class="form-row">

              <div class="form-group col-md-5">
                <label>Rua*</label>
                <input type="text" class="form-control" name="rua" maxlength="50">
              </div>
              <div class="form-group col-md-4">
                <label>Número*</label>
                <input type="text" class="form-control" name="numero" maxlength="4" pattern='\d*'>
                <p>Ei! Este campo só pode ter números.</p>
              </div>
              <div class="form-group col-md-3">
                <label>Complemento</label>
                <input type="text" class="form-control" name="complemento">
              </div>


            </div>
            <div class="form-group">
              <label> Sobre você </label>
              <textarea class="form-control" name="descricao" maxlength="250" value="<?php echo isset($_SESSION['old']) ? $_SESSION['old']['descricao'] : '';?>"> </textarea>
              <span class="text-muted"> Escreva aqui detalhes que acha importante sobre você </span>

            </div>
            <div class="form-row my-5">
              <div class="form-group col-md-6">
                <button type="button" class="btn btn-outline-primary col-md-6" onClick="history.go(-1)"> Voltar </button>

              </div>
              <div class="form-group col-md-6">
                <input type="button" class="btn btn-primary col-md-12" onclick="validar();" value="Cadastrar"></input>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
 </body> 
</html> 
