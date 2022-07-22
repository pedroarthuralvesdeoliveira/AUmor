<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
<title>Sucesso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>
<body >
<?php require_once('header.php'); ?>  
<?php  include 'menu.php'; ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card text-center">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="">Sucesso!</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12"><img class="img-fluid d-block mx-auto" src="http://2.bp.blogspot.com/-aln2ZsCQ95w/VPTTYHbSAeI/AAAAAAAAEyM/irRixGyIEZI/s1600/Png%2Bfinhotinhos%2B3.png" width="100"></div>
              </div>
              <p class="card-text">Sua operação foi realizada com sucesso!</p>
              <button type="button" class="btn btn-outline-primary" onClick="history.go(-2)"> Voltar </button> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
