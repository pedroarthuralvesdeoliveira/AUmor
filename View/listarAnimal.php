<?php
session_start();
require_once('../Config/database.class.php');
require_once('../Controller/AnimalControllerAcessar.php');
require_once('../Controller/UsuarioControllerAcessar.php');
require_once('../DAO/usuariodao.class.php');
require_once('../Model/usuario.class.php');

$db = new Database();
$dao = new UsuarioDAO($db);

$animal = new AnimalControllerAcessar();
$acessarAnimal = $animal->acessar();


$dados = new UsuarioControllerAcessar();
$usuario = $dados->acessar();
if (empty($usuario)) {
  header('Location:login.php');
} else {
  if ($_SESSION['tipoUser'] == 0) {
    header('Location:listarAnimaldoUsuario.php');
  }
}

?>


<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Listar Animais</title>


  <script type="text/javascript">
    var novo = "";

    function listar() {
      var filtro = document.getElementById('filtro-nome');
      var tabela = document.getElementById('lista');
      filtro.onkeyup = function() {
        var nomeFiltro = filtro.value;
        novo = nomeFiltro.toLowerCase();

        for (var i = 1; i < tabela.rows.length; i++) {
          var conteudoCelula = tabela.rows[i].cells[1].innerText;
          var corresponde = conteudoCelula.toLowerCase().indexOf(novo) >= 0;
          tabela.rows[i].style.display = corresponde ? '' : 'none';
        }
      };
    }

    function listarAprovacao() {

      var filtro = document.getElementById('filtro-aprovacao');
      var tabela = document.getElementById('lista');
      if (filtro.value == 'todos') {
        document.location.reload(true);
      } else {
        var nomeFiltro = filtro.value;
        var novo = nomeFiltro.toLowerCase();

        for (var i = 1; i < tabela.rows.length; i++) {
          var conteudoCelula = tabela.rows[i].cells[4].innerText;
          var conteudoCelula = conteudoCelula.toLowerCase();
          if (conteudoCelula == novo) {
            tabela.rows[i].style.display = '';
          } else {
            tabela.rows[i].style.display = 'none';
          }
          // var corresponde = conteudoCelula.indexOf(novo) >= 0;
          // tabela.rows[i].style.display = corresponde ? '' : 'none';
        }
      }
    }

    
  </script>
</head>

<body>
  <?php require_once('header.php'); ?>
  <?php include 'menu.php'; ?>

  <div class=" py-2 container">
    <h1 class="py-4 text-center">Animais Cadastrados</h1>
  </div>
  <div class=" py-2 container">
    <form action="listarAnimal.php" method="POST" name="form" align>
      <select onchange="listarAprovacao()" id="filtro-aprovacao" class="" name="">
        <option value="todos">Todos</option>
        <option value="desaprovado">Desaprovado</option>
        <option value="aprovado">Aprovado</option>
        <option value="em análise">Em Análise</option>
      </select>
      <input onfocus="listar()" id="filtro-nome" type="text" value="" title="Procurar apenas por nome!" placeholder="Procurar...">
    </form>
  </div>
   

    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="lista" class="table">
                <thead class="">
                  <tr>
                    <th scope="col">Imagem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cadastrado por</th>
                    <th scope="col">Status Adoção</th>
                    <th scope="col" style="text-align:center">Status de Aprovação</th>
                    <th scope="col" style="text-align:center"> Altetar status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < count($acessarAnimal); $i++) {
                    // echo "<br>";
                    // print_r($acessarAnimal[$i]["nome"]);
                    // echo "<br>";

                    // $data = explode(" ", $acessarAnimal[$i]['dataInscricao']);
                    // $soData = explode("-", $data[0]);

                    $acessarUsuario = $dao->acessarNome($acessarAnimal[$i]["idUsuario"]);

                    echo "<tr>";

                    echo "<td><img class='d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha' src=imagens/" . $acessarAnimal[$i]["imagem"] . " width= '50px' height='50' ></td>";

                    echo "<td><a href='perfilAnimal.php?id=" . $acessarAnimal[$i]["idAnimal"] . "'>" . $acessarAnimal[$i]["nome"] . "</a></td>";

                    echo "<td>" . $acessarUsuario["nome"] . "</td>";

                    // <td>".$acessarAnimal[$i]["tipo"]."</td>
                    // <td>".$acessarAnimal[$i]["porte"]."</td>
                    // <td>".$acessarAnimal[$i]["sexo"]."</td>

                    if ($acessarAnimal[$i]["statusAdocao"] == 0) {
                      echo "<td>Não adotado</td>";
                    } else {
                      echo "<td>Adotado</td>";
                    }


                    // echo "<td>" . $soData[2] . "/" . $soData[1] . "/" . $soData[0] . "</td>";

                    if ($acessarAnimal[$i]["StatusAprovacao"] == "") {
                      echo "<td class='txAzul'>Em análise</td>";
                    } else if ($acessarAnimal[$i]["StatusAprovacao"] == 0) {
                      echo "<td class='txAzul'> Desaprovado </td>";
                    } else {
                      echo "<td class='txAzul'> Aprovado </td>";
                    }


                    echo "<td > <a href='AprovacaoAdm.php?id=" . $acessarAnimal[$i]["idAnimal"] . "'> Alterar </a> </td>";



                  ?>

                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a href="perfilUsuarioAdmin.php"><button type="button" class="btn btn-outline-primary"> Voltar</button></a>

  </div>
  <?php include 'footer.php'; ?>

</body>

</html>