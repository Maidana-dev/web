<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Ingreso de usuario</title>
		<link rel="stylesheet" type="text/css" href="carpetaCSS/normalize.css">
		<link rel="stylesheet" type="text/css" href="carpetaCSS/login.css">
	</head>
	<body id="fondo">
		
		<div class="cuadro glass-efect">
			
			<form action="confirmar_user.php" method="post">
				<h2>Ingrese su usuario</h2>
				<label for="usuario_cuenta">Usuario </label>
				<input type="text" id="usuario_cuenta" name="usuario_cuenta" placeholder="Usuario" required><br><br>
				<label for="contrasena">Contrasena </label>
				<input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contrasena" required><br><br>
				<button type="submit">Enviar</button><br><br>
				<a href="ingreso_por_user.php">Crear una cuenta</a>
			</form>
			
		</div>
	
		
		
	</body>
</html>


