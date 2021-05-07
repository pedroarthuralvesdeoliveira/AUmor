<?php
session_start();
require_once("../Controller/UsuarioControllerAcessar.php");
require_once("header.php");
$dados = new UsuarioControllerAcessar();
$usuario = $dados->acessar();
if (empty($usuario)) {
	header('Location:login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Edite sua foto</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/d54128f721.js" crossorigin="anonymous"></script>
</head>

<body>
	<?php require_once('header.php'); ?>
	<?php include 'menu.php'; ?>
	<div class="">
	<div class=" py-5 container">
		<h3>Atualizar sua foto</h3>
		<div class="row">
			<form action="../Controller/UsuarioControllerEditarImagem.php" enctype="multipart/form-data" method="POST">
				<div class="form-group">
					<?php echo "<img src=imagens/" . $usuario->imagem . " width= '250px' height='250' class='imagemcertinha'>" ?>
					<input type="hidden" class="form-control" name="idUsuario" value="<?php echo $usuario->idUsuario ?>">
				</div>
				<div class="form-group col">
					<label for="imagem">Imagem:</label>
					<input class="form-control" type="file" name="imagem" required="" />
				</div>

			


		</div>
		<div class="row">

			<div class=" col">
				<button type="submit" class="btn btn-outline-primary">Salvar</button>

				</form>
				<a href="perfilUsuario.php"><button type="button" class="btn btn-outline-primary">Voltar</button></a>
			</div>
		</div>
		</div>
		</div>
</body>

</html>