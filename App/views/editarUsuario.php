<?php
    session_start();
    require_once('header.php');
    require_once("../Controller/UsuarioControllerAcessar.php");
    $dados = new UsuarioControllerAcessar();
    $usuario = $dados->acessar();
    if (empty($usuario)) {
        header('Location:login.php');
    }
    require_once("../Controller/EnderecoControllerAcessar.php");
    $dadosEndereco = new EnderecoControllerAcessar();
    $endereco = $dadosEndereco->acessar();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atualizar seus dados</title>

    <style>
        .margin{
            position:absolute;
            top:65%;
            margin-left:-70px; 
            height: 16px;
        }
    
    </style>

    <script>

        function mascaraTelefone(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value;
            if (telefone.value.length == 3)
                telefone.value = telefone.value + ') ';
            if (telefone.value.length == 9)
                telefone.value = telefone.value + '-';
        }

        function mascaraCep(cep) {
            if (cep.value.length == 5)
                cep.value = cep.value + '-';
        }
    
    </script>
</head>

<body>

    <?php include 'menu.php';?> 

    <div class="py-5 text-center" >
        <div class="container ">
            <div class="wrapper">

                <div class="row" >
                    <div class="mx-auto col-lg-6 col-10 ">
                        <h3 class="my-1">Atualize seus dados</h3>
            
                        <div class="py-5 text-center d-flex justify-content-center">
                        
                            <img class="d-block rounded-circle mx-5 imagemcertinha" src="imagens/<?php echo $usuario->imagem ?>" width="100"  height="100">
                            <a href="editarFotoUsuario.php"> <i class="fas fa-edit fa-lg txAzul margin"></i></a>
                        </div>
                    </div>
                </div>

                <form action="../Controller/UsuarioControllerEditar.php" enctype="multipart/form-data" method="POST">

                    <div class="row justify-content-sm-center my-2">

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="idUsuario" value="<?php echo $usuario->idUsuario ?>" required="">
                        </div>
                        <div class="form-group col-sm-3 ">
                        <label> Nome: </label> 
                            <input type="text" class="form-control" name="nome" value="<?php echo $usuario->nome ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group col-sm-3">
                        <label> Sobrenome </label>
                            <input type="text" class="form-control" name="sobrenome" value="<?php echo $usuario->sobrenome  ?>" maxlength="50" required="">
                        </div>
                    
                    </div>
                    <div class="row justify-content-sm-center  my-2">

                        <div class="form-group  col-sm-3">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" value="<?php echo $usuario->telefone ?>" maxlength="15" onkeypress="mascaraTelefone(this)" required="">
                        </div>

                        <div class="form-group col-sm-3"> 
                            <label> Sobre você </label>
                            <input class="form-control" type="text"  name="descricao" maxlength="250"  value="<?php echo $usuario->descricao ?>" >
                        </div>

                    </div> 
                     
                    <div class="row  my-2">
                    <!--Endereço-->

                        <div class="form-group col-sm-3">
                            <input type="hidden" class="form-control" name="idEndereco" value="<?php echo $endereco->idEndereco ?>" required="">
                        </div>
                        <div class="form-group col-sm-2">
                            <label>CEP</label>
                            <input type="text" class="form-control" name="cep" maxlength="9" onkeypress="mascaraCep(this)" value="<?php echo $endereco->cep ?>" required="">
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Bairro</label>
                            <input type="text" class="form-control" name="bairro" maxlength="50" value="<?php echo $endereco->bairro ?>" required="">
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Rua</label>
                            <input type="text" class="form-control" name="rua" maxlength="50" value="<?php echo $endereco->rua ?>" required="">
                        </div>
                        
                    </div>
                    <div class="row justify-content-md-center  my-2">
                        <div class="form-group col-sm-3">
                            <label>Número</label>
                            <input type="text" class="form-control" name="numero" maxlength="4" pattern='\d*' value="<?php echo $endereco->numero ?>" required="">
                    
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Complemento</label>
                            <input type="text" class="form-control" name="complemento" value="<?php echo $endereco->complemento ?>">
                        </div>
                    
                    </div>
                    <div class="row justify-content-md-center py-5">
                        <button type="button" class="btn btn-outline-primary col-sm-3 mx-1" onClick="history.go(-1)"> Voltar </button>
                        <button type="submit" class="btn btn-primary col-sm-3 mx-1">Atualizar</button>       
                    </div>
                </form>
             </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>  
</body>
</html>