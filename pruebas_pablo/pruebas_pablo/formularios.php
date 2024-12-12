<?php
session_start();

if(isset($_SESSION['last_activity'])) {
	$timeout_duracion = 1800;
	$inactivity_time = time() - $_SESSION['last_activity'];
	
	if($inactivity_time > $timeout_duracion){
		
		header('Location: cerrar_sesion.php');
	}
	
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
		<title>Pagina Formularios</title>
	</head>
	<body>
		<h2>Formulario para ingresar un nuevo empleado</h2>
		<form action="crud.php" method="post">
			<label for="nombre">Nombre: </label>
			<input type="text" id="nombre" name="nombre" placeholder="nombre" required><br><br>
			<label for="dni">DNI: </label>
			<input type="number" id="dni" name="dni" placeholder="DNI" required><br><br>
			<Label for="salario">Salario: </Label>
			<input type="number" id="salario" name="salario" step="0.01" placeholder="salario"><br><br>
			<input type="submit" value="Enviar">
		</form>
		<a href="index.php">Volver</a>
	</body>
</html>
