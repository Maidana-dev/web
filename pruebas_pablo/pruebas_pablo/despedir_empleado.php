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
		<title>Despidir</title>
	</head>
	<body>
		<h2>Eliminar empleado</h2>
		<form action="delete.php" method="post">
			<label for="dni">Nid del empleado:</label>
			<input type="number" id="dni" name="dni" placeholder="DNI del empleado"></br>
			<input type="submit" value="Eliminar">
		</form>
		<a href="index.php">Volver</a>
	</body>
</html>

