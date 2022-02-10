<?php
  session_start();
  require_once('../Controller/AnimalControllerAcessar.php');
  require_once("header.php");
  include 'menu.php';
 
  $animal = new AnimalControllerAcessar();
	$acessarAnimal = $animal->acessarAnimaldoUsuario();


  if (empty($_SESSION['idUsuario'])) {
    header('login.php');
  }

  if (empty($acessarAnimal)){
    if ($_SESSION['statusValidacao'] != 1) {
      echo "
      <div class='py-5 text-center bg-white'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-6'><img class='img-fluid d-block' src='https://media.istockphoto.com/photos/intrigued-picture-id94740594?k=6&m=94740594&s=170667a&w=0&h=zEkLREosyRhNb82Y8plCH5eAGDqYKDgmbF918tzwJpA=' height='100' width='500'></div>
          <div class='col-md-6'>
            <h3 class='mt-5 pt-5'>Poxa, você não cadastrou nenhum animalzinho no momento</h3>
            <div class='row mt-5 pt-5 justify-content-end align-items-end bg-white'>
              <div class='col-md'> <button type='button' class='btn text-white btn-lg btn-block bgAzul butHover' data-bs-toggle='modal' data-bs-target='#modalEmail'> Cadastrar animais</button></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    "; 
    } else{
    echo "
      <div class='py-5 text-center bg-white'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-6'><img class='img-fluid d-block' src='https://media.istockphoto.com/photos/intrigued-picture-id94740594?k=6&m=94740594&s=170667a&w=0&h=zEkLREosyRhNb82Y8plCH5eAGDqYKDgmbF918tzwJpA=' height='100' width='500'></div>
          <div class='col-md-6'>
            <h3 class='mt-5 pt-5'>Poxa, você não cadastrou nenhum animalzinho no momento</h3>
            <div class='row mt-5 pt-5 justify-content-end align-items-end bg-white'>
              <div class='col-md-12'><a class='btn btn-outline-primary btn-lg w-25 text-center text-uppercase' href='cadastrarAnimal.php'>Cadastrar<br></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    ";}}else{

  
?>
<!DOCTYPE html>
<html>
<head>



<meta charset="utf-8">
<title>Listar</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	

<script type="text/javascript">

function listar(){
  var filtro = document.getElementById('filtro-nome');
  var tabela = document.getElementById('lista');
  filtro.onkeyup = function() {
    var nomeFiltro = filtro.value;
    var novo = nomeFiltro.toLowerCase();

    for (var i = 1; i < tabela.rows.length; i++) {
      var conteudoCelula = tabela.rows[i].cells[1].innerText;
      var corresponde = conteudoCelula.toLowerCase().indexOf(novo) >= 0;
      tabela.rows[i].style.display = corresponde ? '' : 'none';
    }
  };
}

</script>


</head>
<body>
<!-- <?php require_once('header.php'); ?>  -->
<!-- <?php  include 'menu.php'; ?>   -->

  <div class=" py-2 container">
    <h1 class="py-4 text-center fontWeight">Animais cadastrados por você</h1>
  </div>

	<div class=" py-2 container">
    <div class="my-3">

     <input onfocus="listar()" id="filtro-nome" type="text" value="" title="Procurar apenas por nome!" placeholder="Procurar..."> <br>

    </div>
    

      <table id="lista" class="table table-borderless">
        <thead class="table-info bgAzul text-white">
          <tr>
		        <th scope="col">Imagem</th>
            <th scope="col">Nome</th>
            <th scope="col">Status de Adoção</th>
            <th scope="col">Status de Aprovação </th>
            <th scope="col" colspan="3" style="text-align:center">Gerenciar</th>
            <!-- <th scope="col">Status de aprovação</th> -->
          </tr>
        </thead>
        <tbody>
        <?php
          for ($i=0; $i < count($acessarAnimal); $i++) {


    				echo "<tr>";
    				echo"<td><img class='d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha' src=imagens/".$acessarAnimal[$i]["imagem"]." width= '50px' height='50' ></td>";
    			
            echo "<td><a class='fontWeight txAzul'  href='perfilAnimal.php?id=".$acessarAnimal[$i]["idAnimal"]."'>".$acessarAnimal[$i]["nome"]."</a></td>
    				";


    				if ($acessarAnimal[$i]["statusAdocao"] == 0) {
    				  echo "<td class='fontWeight' >Não adotado</td>";
    				} else{
    				  echo "<td class='fontWeight' >Adotado</td>";
    				}

            if ($acessarAnimal[$i]["StatusAprovacao"] == "") {
              echo "<td class='fontWeight'> Em Análise  </td>";
            } else if($acessarAnimal[$i]["StatusAprovacao"] == 0){
              echo "<td class='fontWeight'>  Desaprovado <b></td>";
            } else {
              echo "<td class='fontWeight'>  Aprovado </td>";
            } 

            //0 ativo, 1 inativo

            if ($acessarAnimal[$i]["StatusDesativar"] == 0) {
              echo "<td><a class='fontWeight txAzul' href='../Controller/AnimalControllerApagar.php?id=".$acessarAnimal[$i]["idAnimal"]."&status=1'>Ativado</a></td>";
            }else{
              echo "<td><a class='fontWeight txAzul' href='../Controller/AnimalControllerApagar.php?id=".$acessarAnimal[$i]["idAnimal"]."&status=0'>Desativado</a></td>";
            }

            echo "<td><a class='fontWeight txAzul' href='editarAnimal.php?idUsuario=".$acessarAnimal[$i]['idUsuario']."&idAnimal=".$acessarAnimal[$i]["idAnimal"]."'>Editar</a></td>";
            
            if ($acessarAnimal[$i]["statusAdocao"] == 0) {
              echo "<td><a class='fontWeight txAzul' href='listaInteresse.php?idAnimal=".$acessarAnimal[$i]['idAnimal']."'> Interessados</a></td>";
            } else { 
              echo "<td><a class='fontWeight txAzul' href='adocao.php?idAnimal=".$acessarAnimal[$i]["idAnimal"]."'>Consultar Adoção</a></td>";
            }

          }
        ?>
        </tbody>
	    </table>
      <?php } ?>
      <a class="mx-3" href="perfilUsuario.php"> <button type="button" class="btn btn-outline-primary"> Voltar</button> </a>
      
  </div> 
  <?php  include 'footer.php'; 
  ?>
</body>
 <!-- Modal -->
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
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
</html>
