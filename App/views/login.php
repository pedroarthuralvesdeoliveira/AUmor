<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="wrapper">
		<div class="title">Acesse sua conta</div>
		<form action="../Controller/UsuarioControllerLogin.php?acao=" method="post">
			<div class="field">
				<input type="text" name="email" required>
				<label>Email</label>
			</div>
			<div class="field">
				<input type="password" name="senha" required>
				<label>Senha</label>
			</div>
			<div class="field">
				<input type="submit" value="Entrar">
			</div>
			<div class="signup-link">Não é um membro? <a href="cadastrarUsuario.php">Registre-se!</a></div>
		</form>
	</div>
	<div class="">
		<button type="button" class="btn btn-outline-info " onClick="history.go(-1)"> Voltar </button> 
	</div>
</body>
</html>