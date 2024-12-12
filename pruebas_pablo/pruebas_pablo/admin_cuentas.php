<?php
session_start();

$timeout_duracion = 1800;

if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duracion) {
	
	header('Location: cerrar_sesion.php');
	exit();
}

$_SESSION['last_activity'] = time();

if(!isset($_SESSION['username'])){
	header('Location: inicio_de_sesion.php');
	exit();
}
if($_SESSION['rol'] != "admin"){
	header('Location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Pagina cuentas</title>
	</head>
	<body>
		<h2>administrar cuentas</h2>
		<form action="actu_cuentas.php" method="post">
			<label for="user">Ingrese el usuario del que desea hacer el cambio</label></br>
			<input id="user" name="user" placeholder="Usuario" required></br></br>
			<label for="cargo">Ingrese el nuevo rol del usuario</label></br>
			<p>seleccione</p>
			<select id="cargo" name="cargo">
				<option value="admin">administrador</option>
				<option value="public">publico</option>
			</select></br></br>
			<input type="submit" value="Actualizar"></br></br>
		</form>
		<a href="index.php">Volver</a>
	</body>
</html>

