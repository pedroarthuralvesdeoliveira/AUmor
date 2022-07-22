<?php
session_start();
require_once("../Controller/AnimalControllerAcessar.php");
require_once("../Controller/UsuarioControllerAcessar.php");
$dados = new UsuarioControllerAcessar();
$usuario = $dados->acessar();

$dados = new AnimalControllerAcessar;
$animal = $dados->acessarAnimaldoUsuarioParaEditar();
if (!empty($animal->idUsuario)) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Edite a foto do seu animal</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<?php require_once('header.php'); ?>
		<?php include 'menu.php'; ?>
		<div class=" py-5 container">
			<h3>Nova foto do <?php echo $animal->nome ?> </h3>
			<form action="../Controller/AnimalControllerEditarImagem.php" enctype="multipart/form-data" method="POST">
				<div class="row">
					<div class="form-group col-sm">
						<label for="imagem">Imagem:</label>
						<input class="form-control" type="file" name="imagem" required>
					</div>
					<div class="form-group col-sm">
						<input type="hidden" class="form-control" name="idAnimal" value="<?php echo $animal->idAnimal ?>">
						<input type="hidden" class="form-control" name="idUsuario" value="<?php echo $animal->idUsuario ?>">
					</div>
				</div>
				<div class="row">
					<div class=" col-sm-3"></div>
						<button type="submit" class="btn btn-outline-primary">Salvar</button>
						<?php
						echo "<a href='listarAnimaldoUsuario.php?id=$animal->idAnimal'><button type='button' class='btn btn-outline-primary'>Voltar</button></a>";
						?>
					</div>
				</div>
			</form>
	</body>
	</html>
<?php } ?>