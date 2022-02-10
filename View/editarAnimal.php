<?php
session_start();
require_once("../Controller/AnimalControllerAcessar.php");
$animal = new AnimalControllerAcessar();
$acessarAnimal = $animal->acessarAnimaldoUsuarioParaEditar();
if (empty($acessarAnimal->idUsuario)) {
  header('Location:login.php');
}
require_once('header.php');
include 'menu.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
        .margin{
            position:absolute;
            top:65%;
            margin-left:-70px; 
            height: 16px;
        }
    
    </style>


  <title>Editar Animal</title>
</head>

<body>
  <div class=" my-5 py-5 container wrapper">


    <form method="POST" action="../Controller/AnimalControllerEditar.php">

      <div class="row">
        <div class="mx-auto col-lg-6 col-10 text-center">
          <h3 class="my-1">Atualize os dados de <?php echo $acessarAnimal->nome ?> </h3>

          <div class="py-5 text-center d-flex justify-content-center">

            <img class="d-block rounded-circle mx-5 imagemcertinha" src="imagens/<?php echo $acessarAnimal->imagem ?>" width="100" height="100">
            <a href='editarFotoAnimal.php?idUsuario=<?php echo $acessarAnimal->idUsuario ?>&idAnimal=<?php echo $acessarAnimal->idAnimal ?>'> <i class="fas fa-edit fa-lg txAzul margin"></i></a>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <div class="form-group">
          <input type="hidden" class="form-control" name="idUsuario" value="<?php echo $acessarAnimal->idUsuario  ?>">
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" name="idAnimal" value="<?php echo $acessarAnimal->idAnimal  ?>">
        </div>
        <div class="form-group col-sm-3">
          <label>Nome: </label>
          <input type="text" class="form-control" name="nome" value="<?php echo $acessarAnimal->nome ?>" required>
        </div>
        <div class="form-group col-sm-3">
          <label>Idade</label>
          <input type="text" class="form-control" name="idade" value="<?php echo $acessarAnimal->idade ?>">
        </div>
      </div>



      <div class="row d-flex justify-content-center">


        <div class="form-group col-sm-3">
          <label>Comportamento</label>
          <?php
          $vet = explode(',', $acessarAnimal->comportamento);
          // var_dump(array_search("ativo", $vet));
          ?>
          <div>
            <?php
            $d = '';
            $c = '';
            $b = '';
            $s = '';
            $i = '';
            $a = '';
            $atv = '';
            $trt = '';
            $tms = '';
            $agr = '';
            $t = '';

            if (array_search("dócil", $vet) !== false) {
              $d = 'checked';
            }
            if (array_search("calmo", $vet) !== false) {
              $c = 'checked';
            }
            if (array_search("brincalhão", $vet) !== false) {
              $b = 'checked';
            }
            if (array_search("sociável", $vet) !== false) {
              $s = 'checked';
            }
            if (array_search("independente", $vet) !== false) {
              $i = 'checked';
            }
            if (array_search("afetivo", $vet) !== false) {
              $a = 'checked';
            }
            if (array_search("ativo", $vet) !== false) {
              $atv = 'checked';
            }
            if (array_search("territorialista", $vet) !== false) {
              $trt = 'checked';
            }
            if (array_search("teimoso", $vet) !== false) {
              $tms = 'checked';
            }
            if (array_search("agressivo", $vet) !== false) {
              $agr = 'checked';
            }
            ?>
            <input type="checkbox" name="comportamento[]" value="docil" <?php echo $d; ?>>
            <label for="docil"> Dócil </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="calmo" <?php echo $c; ?>>
            <label for="calmo"> Calmo </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="brincalhão" <?php echo $b; ?>>
            <label for="brincalhao"> Brincalhão </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="sociável" <?php echo $s; ?>>
            <label for="sociavel"> Sociável </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="independente" <?php echo $i; ?>>
            <label for="indepedente"> Independente </label>
          </div>
         
        </div>

        <div class="col-sm-3">
       
          <div>
            <input type="checkbox" name="comportamento[]" value="afetivo" <?php echo $a; ?>>
            <label for="afetivo"> Afetivo </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="ativo" <?php echo $atv; ?>>
            <label for="ativo"> Ativo </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="territorialista" <?php echo $trt; ?>>
            <label for="territorialista"> Territorialista </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="teimoso" <?php echo $tms; ?>>

            <label for="teimoso"> Teimoso </label>
          </div>
          <div>
            <input type="checkbox" name="comportamento[]" value="agressivo" <?php echo $agr; ?>>
            <label for="agressivo"> Agressivo </label>
          </div>

        </div>
       
      </div>
      <div class="row d-flex justify-content-center">
        <div class="form-group col-sm-2">
          <label>Sexo*</label><br>
          <?php
          $m = '';
          $f = '';
          if ($acessarAnimal->sexo == 'macho')
            $m = 'checked';
          else $f = 'checked';
          ?>
          <input type="radio" name="sexo" value="macho" <?php echo $m; ?>>
          <label for="macho">Macho</label><br>
          <input type="radio" name="sexo" value="femea" <?php echo $f; ?>>
          <label for="femea">Fêmea</label><br>
        </div>
        <div class="form-group col-sm-2">
          <div class="form-group">
            <label>Tipo*</label><br>
            <?php
            $g = '';
            $c = '';
            if ($acessarAnimal->tipo == 'gato')
              $g = 'checked';
            else $c = 'checked';
            ?>
            <input type="radio" name="tipo" value="cachorro" <?php echo $c; ?>>
            <label for="cachorro">Cachorro</label><br>
            <input type="radio" name="tipo" value="gato" <?php echo $g; ?>>
            <label for="gato">Gato</label><br>
          </div>

        </div>
        <div class="form-group col-sm-2">
          <label>Porte*</label>
          <?php
          $p = '';
          $m = '';
          $g = '';
          if ($acessarAnimal->porte == 'pequeno') {
            $p = 'checked';
          } elseif ($acessarAnimal->porte == 'medio') {
            $m = 'checked';
          } else
            $g = 'checked';
          ?>
          <div>
            <input type="radio" name="porte" value="pequeno" <?php echo $p; ?>>
            <label for="pequeno"> Pequeno </label>
          </div>
          <div>
            <input type="radio" name="porte" value="medio" <?php echo $m; ?>>
            <label for="medio"> Médio </label>
          </div>
          <div>
            <input type="radio" name="porte" value="grande" <?php echo $g; ?>>
            <label for="grande">Grande </label>
          </div>
        </div>


      </div>
      <div class="row d-flex justify-content-center">

        <div class="form-group col-sm-2">
          <label>Saúde</label>
          <?php
          $saude = explode(',', $acessarAnimal->saude);
          // var_dump(array_search("ativo", $vet));
          ?>
          <?php
          $vermifugado = '';
          $vacinado = '';
          $castrado = '';

          if (array_search("vermifugado", $saude) !== false) {
            $vermifugado = 'checked';
          }
          if (array_search("vacinado", $saude) !== false) {
            $vacinado = 'checked';
          }
          if (array_search("castrado", $saude) !== false) {
            $castrado = 'checked';
          }
          ?>
          <div>
            <input type="checkbox" name="saude[]" value="vermifugado" <?php echo $vermifugado ?>>
            <label for="vermifugado"> Vermifugado </label>
          </div>
          <div>
            <input type="checkbox" name="saude[]" value="vacinado" <?php echo $vacinado ?>>
            <label for="vacinado"> Vacinado </label>
          </div>
          <div>
            <input type="checkbox" name="saude[]" value="castrado" <?php echo $castrado ?>>
            <label for="castrado"> Castrado </label>
          </div>
        </div>

        <div class="form-group col-md-4">
          <label>Motivo da adoção</label>
          <input type="text" class="form-control " name="motivoAdocao" value="<?php echo $acessarAnimal->motivoAdocao ?>">
        </div>


      </div>

      <div class="row d-flex justify-content-center">
        <button type="button" class="btn btn-outline-primary col-sm-3 mx-1" onClick="history.go(-1)">Voltar</button></a>
        <button type="submit" class="btn btn-primary col-sm-3 mx-1">Confirmar</button> <br><br>
        

      </div>


    </form>

  </div>






  </div>
</body>
<?php include 'footer.php'; ?>

</html>