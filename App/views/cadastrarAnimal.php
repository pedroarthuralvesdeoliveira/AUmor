<!DOCTYPE html>
<html>

<?php 
    session_start();
    require_once('header.php'); 

    if(empty($_SESSION['idUsuario'])){
        header('Location:login.php');
    }
?>  
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>
</head>
<html>
<body>
<?php  include 'menu.php'; ?>  

<div class="py-5 text-center" >
    <div class="container">
        <div class="row " >
            <div class="mx-auto col-lg-6 col-10 bgAzulTR wrapper">

                <div class="py-5 text-center">
                    <div class="d-block mx-auto mb-4" alt="" width="72" height="57">
                        <i class="fas fa-paw fa-3x"></i>    
                    </div>
                    <h2 class="fontWeight">Cadastre seu animalzinho aqui!</h2>
                    <span class="text-muted"> * Campos obrigatórios </span>
                </div>
    
    <form class="text-left" enctype="multipart/form-data" action="../Controller/AnimalControllerInserir.php" id="formulario" name="formulario" method="POST">
               
                    <div class="form-group">
                        <label>Nome*</label>
                        <input type="text" class="form-control" size="255" maxlength="30" name="nome" required>
                    </div>

                    <div class="form-group"> 
                        <label>Idade aproximada </label>
                        <input type="text" class="form-control" name="idade" maxlength="2" pattern='\d*'>
                        <p>Ei! Este campo só pode ter números.</p>
                        <small class="form-text text-muted">Você pode deixar em branco se não souber</small>
                    </div>

                    <hr class="my-4">
                    <div class="form-row"> <label class="col-md-8"><b>Comportamento</b></label>  <label class="col-md-2"> <b>Sexo* </b></label><br></div>
           
            <div class="form-row">
                <div class="form-group col-md-4">
                
                    <div>
                        <input type="checkbox" name="comportamento[]" value="dócil">
                        <label for="docil"> Dócil </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="calmo">
                        <label for="calmo"> Calmo </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="brincalhão">
                        <label for="brincalhao"> Brincalhão </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="sociável">
                        <label for="sociavel"> Sociável </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="independente">
                        <label for="indepedente"> Independente </label>
                    </div>
                    
                </div>
                <div class="form-group col md-4">
                    
                    <div>
                        <input type="checkbox" name="comportamento[]" value="afetivo">
                        <label for="afetivo"> Afetivo </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="ativo">
                        <label for="ativo"> Ativo </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="territorialista">
                        <label for="territorialista"> Territorialista </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="teimoso">
                        <label for="teimoso"> Teimoso </label>
                    </div>
                    <div>
                        <input type="checkbox" name="comportamento[]" value="agressivo">
                        <label for="agressivo"> Agressivo </label>
                    </div>

                </div>

                <div class="form-group col-md-4">

                    <input type="radio" name="sexo" value="macho" >
                    <label for="macho">Macho</label><br>
                    <input type="radio" name="sexo" value="femea" required>
                    <label for="femea">Fêmea</label><br>
                            
                </div>
            </div>
            <hr class="my-4">
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label> <b>Tipo* </b></label><br>
                    <input type="radio" name="tipo" value="cachorro" required>
                    <label for="cachorro">Cachorro</label><br>
                    <input type="radio" name="tipo" value="gato">
                    <label for="gato">Gato</label><br>
                </div>
                
                <div class="form-group col-md-4">
                    <label><b>Porte*</b></label>
                        <div>
                            <input type="radio" name="porte" value="pequeno">
                            <label for="pequeno"> Pequeno </label>
                        </div>
                        <div>
                            <input type="radio" name="porte" value="medio" required>
                            <label for="medio"> Médio </label>
                        </div>
                        <div>
                            <input type="radio" name="porte" value="grande" required>
                            <label for="grande">Grande </label>
                        </div>
                </div>
                <div class="form-group col-md-4">
                    <label><b>Saúde</b></label>
                
                    <div>
                        <input type="checkbox" name="saude[]" value="vermifugado">
                        <label for="vermifugado"> Vermifugado </label>
                    </div>
                    <div>
                        <input type="checkbox" name="saude[]" value="vacinado">
                        <label for="vacinado"> Vacinado </label>
                    </div>
                    <div>
                        <input type="checkbox" name="saude[]" value="castrado">
                        <label for="castrado"> Castrado </label>
                    </div>
                </div>
        </div>
        
 
        <hr class="my-4">

        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input class="form-control" type="file" name="imagem" required>
        </div>
        <div class="form-group">
            <label>Motivo da adoção</label>
            <input type="text" class="form-control"  size="255" name="motivoAdocao">
            <small class="form-text text-muted">Informe o motivo da adoção do animal, você pode adicionar mais informações que acha importante.</small>
      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
          <button type="button" class="btn btn-outline-primary col-md-6" onClick="history.go(-1)"> Voltar </button> 
            
            </div>
            <div class="form-group col-md-6">

            <?php 
                if ($_SESSION['statusValidacao'] != 1) {
                echo "<button type='button' class='btn btn-primary col-md-12' data-bs-toggle='modal' data-bs-target='#modalEmail'> Cadastrar</button> ";        
                } 
                echo "<button type='submit' class='btn btn-primary col-md-12'>Cadastrar </button>";
            ?>
          </div>
        </div>

    </div>

    </form>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
</body>
</html>


