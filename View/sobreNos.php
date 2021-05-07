<!DOCTYPE html>
<html>

<style>
  .grow:hover {
    -webkit-transform: scale(5.3);
    -ms-transform: scale(1.3);
    transform: scale(1.2);
    transition-duration: 1.3s;
  }
</style>

<head>
  <?php
  session_start();
  require_once('header.php'); ?>
  <?php include 'menu.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12"><img class="img-fluid d-block mx-auto grow" src="https://www.curtamais.com.br/uploads/midias/f3c5bb7bb85302e80f0104ff61dbe840.jpg" width="400"></div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Sobre a adoção de pets</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 p-3">
          <p>Pensa em ter um animalzinho de estimação? Que tal optar pela adoção? Adotar é sempre um gesto de muito amor e carinho, pois além de proporcionar um novo lar para o pet, você ganhará um novo amigo que será sempre grato e fiel companheiro. Mas, além da vontade de adotar, é preciso ter responsabilidade com o animalzinho. Levando em consideração que o bichinho já passou por situações adversas, é preciso um cuidado especial com ele. </p>
        </div>
        <div class="col-md-6 p-3">
          <p>Sabemos que adotar um novo pet é sempre se colocar diante de algo imprevisível. Nunca é possível saber como ele será, e essa é a melhor parte para quem gosta de experiências novas. Geralmente, cachorros ou gatos que já moraram nas ruas se mostram muito dóceis, amáveis e até mesmo carentes por atenção. Ganhando sua confiança, você terá um amigo verdadeiramente fiel.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5" style="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Sobre a criação do sistema</h1>
        </div>
      </div>
      <div class="row">
        <div class="mx-auto col-md-11">
          <p class="text-center">A ideia de criação de um site voltado aos pets surgiu desde o início do planejamento do sistema, mas ao decorrer do ano, nossa ideia passou de um simples feed de animais achados, perdidos e para adoção para um sistema completo envolvendo a adoção de cães e gatos.&nbsp;<br>A importância desse tema foi se tornando cada vez mais clara ao decorrer da pandemia do Covid-19, onde devido as pequisas feitas, conseguimos observar que canis e ong's estavam superlotados, principalmente porque os eventos de adoção (que era onde eles mais conseguiam arrumar lar para os pets) não poderiam mais acontecer por conta da quarentena.<br>Dessa forma, uma plataforma, onde pessoas, ong's, canis, etc possam realizar cadastros e adoções de animais de forma on-line é uma forma de manter o distanciamento social e conseguir novos lares para nossos amigos de quatro patas!</p>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-6 p-3"> <img class="img-fluid d-block" src="https://scontent.figu4-1.fna.fbcdn.net/v/t1.6435-9/182290753_3629639190497495_9119733383107932831_n.jpg?_nc_cat=103&amp;ccb=1-3&amp;_nc_sid=09cbfe&amp;_nc_ohc=7I5iWk6cceMAX-tx2RT&amp;_nc_ht=scontent.figu4-1.fna&amp;oh=327a830c0507ea515699ae2bb2686470&amp;oe=60B59CA4" width="350">
          <h3 class="my-3"><b>Alessandra Jaroseski</b></h3>
          <p class="text-center">19 anos, estudante do IFPR - Curso Técnico em Informática. É apaixonada por animais, reside em Foz do Iguaçu e pretende seguir carreira na área da saúde.</p>
        </div>
        <div class="col-md-4 col-6 p-3"> <img class="img-fluid d-block" src="https://scontent.figu4-1.fna.fbcdn.net/v/t31.18172-8/24831319_1263825827050611_4807504543522929363_o.jpg?_nc_cat=105&amp;ccb=1-3&amp;_nc_sid=174925&amp;_nc_ohc=v0O83f06TQQAX8SULez&amp;_nc_ht=scontent.figu4-1.fna&amp;oh=b54057da59c12606a968ff4b92ded2de&amp;oe=60B4AE29" width="350">
          <h3 class="my-3"> <b>Natania Pereira Inez</b><br></h3>
          <p class="text-center">Estudante do IFPR, Foz do Iguaçu. Cursando técnico em informática, 19 anos e defensora dos animais. </p>
        </div>
        <div class="col-md-4 col-6 p-3"> <img class="img-fluid d-block" src="https://lh3.googleusercontent.com/a-/AOh14Gi1_ppHo_C1z4MFRr9JthOGJB1XxJ6gicHaCs4-AA=s400-c" width="350">
          <h3 class="my-3"> <b>Pedro Arthur de Oliveira</b></h3>
          <p>18 anos, estudante do curso técnico em informática integrado ao ensino médio no IFPR. </p>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include 'footer.php'; ?>

</html>