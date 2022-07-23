<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
  .bgAzul {

    background-color: #82D1E2;
  }

  .txAzul {

    color: #82D1E2;

  }

  .but {

    color: white;

  }

  .but:hover {
    background: #13cdf5;
    color: white;

  }

</style>

<body>
  <?php

  require_once('../vendor/autoload.php');
  $route = new \App\Route;

  session_start();

  require_once('../App/views/header.php'); ?>

  <?php include 'menu.php'; ?>

  <div class="py-5 align-items-center d-flex bgAzul">
    <div class="container py-5 bgAzul">
      <div class="row">
        <div class="col-md-6 px-md-5 position-relative">
          <div class="position-absolute bottom-0 end-0 swing"></div>
          <h1 class="display-3 mb-4 d-flex justify-content-center text-white " style="white-space: nowrap"> Adote um amigo</h1>
          <div class="d-flex justify-content-center"> </div>


          <div class="position-absolute top-50 start-50 translate-middle">
            <div class="col-md-12"><a class="btn bgAzul px-5 btn-outline-light" href="feedAnimais.php">Adotar</a></div>
          </div>

        </div>

        <div class="col-md-6 d-flex justify-content-center"><img class="img-fluid d-block" height="600px" width="300px" src="https://imagensemoldes.com.br/wp-content/uploads/2020/04/cachorro-com-fundo-transparente.png"></div>
      </div>
    </div>
  </div>
  <div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mb-3">Seja um colaborador, adote um pet!</h1>
          <p>A iniciativa AUmor surgiu da necessidade de encontrar um lar para cães e gatos que cada dia mais estão sendo abandonados, principalmente diante da pandemia do Coronavírus. Ajude a causa e adote um pet, leve alegria para sua casa! &nbsp;</p>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php';  ?>

</body>

</html>