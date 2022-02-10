<?php
session_start();

require_once('../Controller/ListaInteresseControllerAcessar.php');
$usuario = new ListaInteresseControllerAcessar();
$dados = $usuario->buscarUsuario();

require_once('../DAO/animaldao.class.php');
$db = new Database();
$animalBusca = new AnimalDAO($db);

if (empty($dados)) {
  $resposta = 1;
} else {
  $resposta = 0;
}

?>
<!DOCTYPE html>
<html>
<title>Animais de seu interesse</title>
<?php require_once('header.php'); ?>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<?php include 'menu.php'; ?>
<?php
if ($resposta == 1) {
  echo " <div class='py-5 text-center bg-white'>
    <div class='container'>
      <div class='row'>
        <div class='col-md-6'><img class='img-fluid d-block' src='https://media.istockphoto.com/photos/intrigued-picture-id94740594?k=6&m=94740594&s=170667a&w=0&h=zEkLREosyRhNb82Y8plCH5eAGDqYKDgmbF918tzwJpA=' height='100' width='500'></div>
        <div class='col-md-6'>
          <h3 class='mt-5 pt-5'>Poxa, parece que você não está na lista de nenhum animal!</h3>
          <div class='row mt-5 pt-5 justify-content-end align-items-end bg-white'>
            <div class='col-md-12'><a class='btn btn-outline-primary btn-lg w-25 text-center text-uppercase' href='feedAnimais.php'>Adote<br></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>";
} else {
?>
  <div class="container">
    <table id="lista" class="table table-bordered" border="1">
      <h1 class="py-4 text-center">Lista de animais que você tem interesse</h1>
      <thead class="table-info">
        <tr>
          <th scope="col" class="text-center">Animal</th>
          <th scope="col" class="text-center">Data de interesse</th>
          <th scope="col" class="text-center">Cancelar solicitação de adoção <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Ao cancelar a solicitação de adoção, você sairá da lista de interessados do animal."></i></th>
        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($dados as $Lista) {
          $data = explode(" ", $Lista['dataInteresse']);
          $soData = explode("-", $data[0]);

          $dadosAnimal = $animalBusca->buscarAnimal($Lista["idAnimal"]);
          echo "<tr>";
          foreach ($dadosAnimal as $animal) {
            echo "<td class='text-center'><a href='perfilAnimal.php?id=" . $animal["idAnimal"] . "'>" . $animal["nome"] . "</td>";
            echo "<td class='text-center'>" . $soData[2] . "/" . $soData[1] . "/" . $soData[0] . "</td>";
            echo "<td class='text-center'><a class='text-center'  href='../Controller/ListaInteresseControllerDesistencia.php?idUsuario=" . $Lista["idUsuario"] . "&idAnimal=" . $animal["idAnimal"] . "'><button class='btn btn-outline-danger'> Cancelar </button></a></td>";
          }
        }

        ?>
      </tbody>
    </table>
  </div>
  <!-- Modal -->
  <!-- <div class="modal fade" id="modalCerteza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja continuar?</h5>
            
          </div>
          <div class="modal-body">
           Ao cancelar sua solicitação de adoção você será retirado da lista de interesse de <?php echo $animal["nome"] ?>. Deseja continuar?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

            <?php echo "<a class='btn bgAzul but'  href='../Controller/ListaInteresseControllerDesistencia.php?idUsuario=" . $Lista["idUsuario"] . "&idAnimal=" . $animal["idAnimal"] . "'>Confirmar</a>"; ?>  
          </div>
        </div>
      </div>
    </div> -->

    


  <?php
  include 'footer.php';
  ?>
<?php  } ?>

</html>