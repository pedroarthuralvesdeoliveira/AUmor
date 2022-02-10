<?php

session_start();

require_once('../Controller/ListaInteresseControllerAcessar.php');
require_once('../DAO/animaldao.class.php');

$animalLista = new ListaInteresseControllerAcessar();
$dados = $animalLista->buscarLista();

$nomeAnimal = $animalLista->buscarNomeAnimal();

$db = new Database();

$animal = new AnimalDAO($db);

$dadosAnimal = $animal->buscarAnimal($_GET["idAnimal"]);


if (empty($dados)) {
  $resposta = 1;
} else {
  $resposta = 0;
}

?>
<!DOCTYPE html>
<html>
<?php require_once('header.php') ?>

<script>
function confirmarAdocao(idUsuario, idAnimal,nomeUsuario){
        $('#modalCerteza').modal('show');
        document.getElementById("idUsuario").value = idUsuario;
        document.getElementById("idAnimal").value = idAnimal;
        document.getElementById("nomeconf").append(nomeUsuario);
}
</script>

<?php include 'menu.php' ?>
<?php
if ($resposta == 1) {
  echo "
    <div class='py-5 text-center bg-white'>
    <div class='container'>
      <div class='row'>
        <div class='col-md-6'><img class='img-fluid d-block' src='https://media.istockphoto.com/photos/intrigued-picture-id94740594?k=6&m=94740594&s=170667a&w=0&h=zEkLREosyRhNb82Y8plCH5eAGDqYKDgmbF918tzwJpA=' height='100' width='500'></div>
        <div class='col-md-6'>
          <h3 class='mt-5 pt-5'>Poxa, no momento não tem nenhum interessado no seu animalzinho!</h3>
          <div class='row mt-5 pt-5 justify-content-end align-items-end bg-white'>
            <div class='col-md-12'><a class='btn btn-outline-primary btn-lg w-25 text-center text-uppercase' href='listarAnimaldoUsuario.php'>Voltar<br></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  ";
} else {
?>
<div class="container wrapper my-5">

  <table id="lista" class="table table-bordered" border="1">
    <h1 class="py-4 text-center">Lista de interessados de <?php echo $nomeAnimal->nome ?> </h1>
    <thead class="table-info">
      <tr>
        <th scope="col">Nome do usuário</th>
        <th scope="col">Email do usuário</th>
        <th scope="col">Telefone do usuário</th>
        <th scope="col">Descrição</th>
        <th scope="col">Data de interesse</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once('../DAO/usuariodao.class.php');
        $usuario = new UsuarioDAO($db);

        foreach ($dados as $Lista) {
          $data = explode(" ", $Lista['dataInteresse']);
          $soData = explode("-", $data[0]);

          $dadosUsuario = $usuario->buscaUsuario($Lista["idUsuario"]);

          echo "<tr>";

          foreach ($dadosUsuario as $Usuario) {
            echo "<td>" . $Usuario["nome"] . "</td>
            <td>" . $Usuario["email"] . "</td>
            <td>" . $Usuario["telefone"] . "</td>
            <td>" . $Usuario["descricao"] . "</td>";

            echo "<td>" . $soData[2] . "/" . $soData[1] . "/" . $soData[0];
      ?>
          <td><a class="btn bgAzul but" data-bs-toggle="modal" data-bs-target="#modalCerteza" onclick="confirmarAdocao(<?php echo $Usuario['idUsuario'].','.$_GET['idAnimal'].',\''.$Usuario['nome'].'\'' ?>)"> Aprovar </a></td>
      <?php
          }
        }
      ?>

    </tbody>
  </table>
  </div>
<?php } ?>
<?php include 'footer.php'; ?>
 <!-- Modal -->
 <div class="modal fade" id="modalCerteza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja continuar?</h5>
          </div>
          <div class="modal-body">
            <form method='get' action='../Controller/ListaInteresseControllerPermissao.php'>
            <input type='hidden' name='idUsuario' id='idUsuario'>
            <input type='hidden' name='idAnimal' id='idAnimal'>
            <input type='hidden' name='status' value='1'>
              Tem certeza que deseja doar <?php echo $nomeAnimal->nome ?> para <span id='nomeconf'></span> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onClick="history.go(0)">Cancelar</button>
            <button type="submit" class="btn btn-success">Confirmar</button>
            <?php // echo "<a class='btn bgAzul but' href='../Controller/ListaInteresseControllerPermissao.php?idUsuario=" . $Lista["idUsuario"] . "&idAnimal=" . $Lista["idAnimal"] . "&status=1'>Aprovar</a>";?>  
          </div>
          </form>
        </div>
      </div>
    </div>
</html>