
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

?>

<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Buscador de Empleados</title>
	</head>
	<body>
		<h2>Buscador de Empleados</h2>
		<?php include 'buscar_empleado.php';?>
		
		<?php include 'procesar_busqueda.php'?>
		<a href="index.php">Volver</a>
	</body>
</html>

