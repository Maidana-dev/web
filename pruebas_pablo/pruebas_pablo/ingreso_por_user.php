<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Ingreso de usuario</title>
	</head>
	<body>
		<h1>Cree su usuario</h1>
		<form action="conex_user.php" method="post">
			<label for="usuario_cuenta">Usuario: </label>
			<input type="text" id="usuario_cuenta" name="usuario_cuenta" placeholder="Usuario" required><br><br>
			<label for="contrasena">Contrasena: </label>
			<input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contrasena" required><br><br>
			<label for="correo">Email: </label>
			<input type="email" id="correo" name="correo" placeholder="Email" required><br><br>
			<label for="telefono">Telefono: </label>
			<input type="tel" id="telefon" name="telefono" placeholder="Telefono/opcional"><br><br>
			<input type="submit" value="Ingresar">
		</form>
		<a href="inicio_de_sesion.php">Volver</a>
	</body>
</html>

