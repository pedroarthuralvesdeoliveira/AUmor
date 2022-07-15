<?php
session_start();
require_once('../Controller/AnimalControllerAcessar.php');
$animal = new AnimalControllerAcessar();
$acessarAnimal = $animal->acessarAnimaisAtivos();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Feed de Animais</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .hoverzoom {
      position: relative;

      width: 270px;
      height: 300px;
      overflow: hidden;
    }

    .hoverzoom img {
      width: 100%;
      border-radius: 2px;
      -webkit-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -moz-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -ms-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -o-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
    }

    .hoverzoom:hover img {
      -webkit-transform: scale(1.5);
      -moz-transform: scale(1.5);
      -ms-transform: scale(1.5);
      -o-transform: scale(1.5);
      transform: scale(1.2);
      transition-duration: 3.0s;
    }

    .hoverzoom .retina {
      position: absolute;
      width: 300px;
      height: 220px;
      top: 0;
      left: 0;
      opacity: 0;
      background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
      border-radius: 2px;
      text-align: center;
      padding: 30px;

      -webkit-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -moz-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -ms-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      -o-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
      
    }

    .hoverzoom:hover .retina {
      opacity: 1;
      box-shadow: inset 0 0 100px 50px rgba(0, 0, 0, .2);
      

    }

    .hoverzoom .retina a {
      display: block;
      width: 150px;
      border-radius: 4px;
      color: #fff;
      text-decoration: none;
      text-align: center;
      padding: 10px 15px;
      margin: 16px auto 0;
      display: block;
      margin-right: 25%;
      font-size: 30px;
    }
  </style>

</head>
<body>
  <?php require_once('header.php'); ?>
  <?php include 'menu.php'; ?>
  <div class="container py-3">
    <h1 class="py-4 text-center">Animais disponíveis para adoção</h1>

    <div class="justify-content-center align-items-center ml-5 pl-5 my-2 ">
      <div class="container align-items-center justify-content-center">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-12 align-items-center justify-content-center ml-5 pl-5">
            <form id="filtrarAnimais" class="align-center justify-content-center align-items-center ml-5 pl-5">
              <select class="form-select form-select-lg algin-center mb-3 align-items-center justify-content-center" id="porte">
                <option selected="" disabled="" value="Porte">Porte</option>
                <option value="todos">Todos</option>
                <option value="pequeno">Pequeno</option>
                <option value="medio">Médio</option>
                <option value="grande">Grande</option>
              </select>
              <select class="form-select form-select-lg mb-3" id="sexo">
                <option selected="" disabled="" value="Sexo">Sexo</option>
                <option value="todos">Todos</option>
                <option value="macho">Macho</option>
                <option value="femea">Fêmea</option>
              </select>
              <select class="form-select form-select-lg mb-3" id="tipo">
                <option selected="" disabled="" value="Tipo">Tipo</option>
                <option value="todos">Todos</option>
                <option value="gato">Gato</option>
                <option value="cachorro">Cachorro</option>
              </select>
              <button class=" btn text-white btn-sm bgAzul" type="submit">Filtrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row m-5" id="animalView">
      <?php for ($i = 0; $i < count($acessarAnimal); $i++) { ?>
        <!-- CONTAINER -->
        <div class="col-lg-4 col-sm-4 col-6">
          </br>
          <div class="hoverzoom">
            <?php echo "<img class='imagemcertinha' src=imagens/" . $acessarAnimal[$i]["imagem"] . " width='100%'  height= '200px' >" ?>
            <div class="card-body mt-3 mb-0">
              <div class="retina">
                <?php
                echo "<td class='text-center' ><a href='perfilAnimal.php?id=" . $acessarAnimal[$i]["idAnimal"] . "'>" . $acessarAnimal[$i]["nome"] . "</a>";
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class=" py-2 container"></div>
    <button type="button" class="btn btn-outline-primary" onClick="history.go(-1)">Voltar</button>
  </div>
</body>
<script type='text/javascript' src='filtro.js'></script>
<?php include 'footer.php'; ?>

</html>