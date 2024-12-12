
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


if(isset($_POST['id']) /*&& isset($_POST['usuario_cuenta'])*/){
	$id_destino = $_POST['id'];
	//$nombre_destino = $_POST['usuario_cuenta'];
	//$_SESSION['nombre_destino'] = $nombre_destino;
}else{
	$id_destino = $_SESSION['id_destino'];
	//$nombre_destino = $_SESSION['nombre_destino'];
}
?>



<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Pagina </title>
		<link rel="stylesheet" type="text/css" href="carpetaCSS/chat.css">
		
	</head>
	<body>
		<div style="text-align: center;">
			<h1>Pagina Principal</h1>
		</div>
		
		<div class="chat-box" id="chat-box">
			<?php include "get_mensajes.php";
			$mensa = new traer_mensajes($id_destino, $_SESSION['id']);
			$mensa->mostrarMensajes();
			?>
		</div>		
		<form action="send_mensage.php" method="post">
			<input type="text" id="message" name="message" class="message-input" placeholder="Escribir..." required>
			<input type="hidden" name="destinatario" value="<?php echo htmlspecialchars($id_destino); ?>">
			<button type="submit" class="bottom">Enviar</button></br></br>
		</form>
		<a href="buscar_usuario.php">Volver</a>
	</body>
</html>
