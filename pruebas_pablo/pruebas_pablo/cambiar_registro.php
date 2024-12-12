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
		<title>Actualizar empleado</title>
	</head>
	<body>
		<h2>Actualizacion de registros</h2>
		<form action="update.php" method="post">
			<label for="dni">Ingrese el nid del Empleado al que desea hacer el cambio de Salario</label></br>
			<input type="number" id="dni" name="dni" placeholder="DNI" required><br><br>
			<label for="salario">Nuevo salario:</label>
			<input type="number" id="salario" name="salario" placeholder="Nuevo salario" step="0.01" required><br><br>
			<input type="submit" value="Actualizar">
		</form>
		
		<a href="index.php">Volver</a></br></br>
	</body>
</html>

