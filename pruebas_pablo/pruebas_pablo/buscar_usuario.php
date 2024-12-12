

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
		<title>Buscador de Usuarios</title>
		<link rel="stylesheet" type="text/css" href="carpetaCSS/buscar_user.css">
	</head>
	<body id="fondo">
		<div class="buscador">
			<h2>Buscador de Usuarios</h2>
			<form action="buscar_usuario.php" method="POST">
				<input type="text" id="buscador" name="buscador" class="buscador__busqueda" placeholder="Buscar..."></br></br>
				<button type="submit" class="boton"> Buscar</button></br></br>
			</form>	
		</div>
		<div class="busqueda">
			<?php include 'busqueda_user.php';
				$busqueda = new Busqueda;
				$busqueda->ejecucion();
			?>

			
		</div>
		<div style="text-align:center;">
			</br>
			<a href="index.php" class="boton_salir">Volver</a>	
		</div>
		
	</body>
</html>
