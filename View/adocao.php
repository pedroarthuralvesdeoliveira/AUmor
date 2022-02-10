<?php 
    require_once('../Controller/AdocaoControllerAcessar.php');
    require_once('../DAO/usuariodao.class.php');
    require_once('../DAO/animaldao.class.php');
    $adocaoAcessar = new AdocaoControllerAcessar();
    $adocaoAnimal = $adocaoAcessar->acessar();
    $nomeAnimal = $adocaoAcessar->nomeAnimal(); 
    // 
    $antigosDonos = $adocaoAcessar->devolucao();
    // print_r($antigosDonos["dataDevolucao"]);
    // print_r($antigosDonos["idUsuarioFinal"]);
    // echo "<pre>";
    // print_r($antigosDonos);
    // echo "</pre>";
    // die();

    $db = new Database();
    $usuario = new UsuarioDAO($db);
    $animal = new AnimalDAO($db); 
    session_start();
    
   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Adoção</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php require_once('header.php'); ?>  
<?php  include 'menu.php'; ?>  
<div class="container wrapper my-5 p-4 ">

<table id="lista" class="table table-bordered" border="1">
<h1 class="py-4 text-center">Dados de adoção de <?php echo $nomeAnimal->nome ?> </h1>
  <thead class="table-info">
    
    <?php 
        if (empty($antigosDonos) == false ) {
          echo "
          <tr>
          <th scope='col' class='text-center'>Antigo(s) dono(s) do pet: </th>
          <th scope='col' class='text-center'>Email:</th>
          <th scope='col' class='text-center'>Telefone:</th>
          <th scope='col' class='text-center'>Data da adoção:</th>
          <th scope='col' class='text-center'>Data da devolução: </th>
          </tr>
          ";
        
    ?>
    
  </thead>
  <tbody>
    <?php
        // $antigoDono  = $usuario->buscaUsuario($antigosDonos["idUsuarioFinal"]);
        }
      

        if (empty($antigosDonos) == false ) {
        foreach ($antigosDonos as $donoAntigo){
          echo "<tr>";
          echo "<td class='text-center'>".$donoAntigo["nome"]."<br><img class=' d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha' width='100' height='100' src='imagens/".$donoAntigo['imagem']."'</td>
          <td class='text-center'>".$donoAntigo["email"]."</td>
          <td class='text-center'>".$donoAntigo["telefone"]."</td>";
        echo "<td class='text-center'>".date_format(date_create($donoAntigo['dataAdocao']), 'Y/m/d')."</td>";
        echo "<td class='text-center'>".date_format(date_create($donoAntigo['dataDevolucao']), 'Y/m/d')."</td>";
        echo "</tr>";
      }
        }          
    ?>
  </tbody>
  <thead class="table-info">
    <tr>
      <!-- </?php  -->
        <!-- if (empty($antigosDonos) == false ) {
          echo "
          <th scope='col' class='text-center'>Antigo(s) dono(s) do pet: </th>
          <th scope='col' class='text-center'>Email:</th>
          <th scope='col' class='text-center'>Telefone:</th>
          <th scope='col' class='text-center'>Data da devolução: </th>
          ";
        } -->
      <!-- ?/> -->
      <th scope='col' class='text-center'>Novo dono do pet: </th>
      <th scope="col" class="text-center">Email:</th>
      <th scope="col" class="text-center">Telefone:</th>
      <th scope="col" class="text-center">Data da adoção:</th>
      <th scope="col" class="text-center">Registrar Devolução:</th>
    </tr>
  </thead>
  <tbody>
    <?php
        // $antigoDono  = $usuario->buscaUsuario($antigosDonos["idUsuarioFinal"]);
        $dadosUsuario = $usuario->buscaUsuario($adocaoAnimal->idUsuarioFinal);
        $dadosAnimal = $animal->buscarAnimal($adocaoAnimal->idAnimal);
        echo "<tr>";

        // if (empty($antigosDonos) == false ) {
        // foreach ($antigoDono as $donoAntigo){
        //   echo "<td class='text-center'>".$donoAntigo["nome"]."<br><img width='150' height='150' src='imagens/".$donoAntigo['imagem']."'</td>
        //   <td class='text-center'>".$donoAntigo["email"]."</td>
        //   <td class='text-center'>".$donoAntigo["telefone"]."</td>";
        // }
        // echo "<td class='text-center'>".$antigosDonos["dataDevolucao"]."";
        // }  

        foreach ($dadosUsuario as $Usuario) {
            echo "<td class='text-center'>".$Usuario["nome"]."<br><img class=' d-block rounded-circle mt-2 mb-0 mx-auto imagemcertinha' width='100' height='100' src='imagens/".$Usuario['imagem']."'</td>
            <td class='text-center'>".$Usuario["email"]."</td>
            <td class='text-center'>".$Usuario["telefone"]."</td>";
        }
        echo "<td class='text-center'>".date_format(date_create($adocaoAnimal->dataAdocao), 'Y/m/d')."</td>";
        echo "<td class='text-center'><a  class='btn bgAzul but' data-bs-toggle='modal' data-bs-target='#modalCerteza''>Confirmar</td></tr>";
        
    ?>
</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalCerteza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja continuar?</h5>
            
          </div>
          <div class="modal-body">
           Deseja mesmo registrar a devolução do animal?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <?php echo "<a class='btn bgAzul but' href='../Controller/AdocaoControllerDevolucao.php?idAnimal=".$adocaoAnimal->idAnimal."&status=0&statusAdocao=1'href='../Controller/AdocaoControllerDevolucao.php?idAnimal=".$adocaoAnimal->idAnimal."&status=0&statusAdocao=1'>Confirmar</a>";?>  
          </div>
        </div>
      </div>
    </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php include 'footer.php'; ?> 
</html>

