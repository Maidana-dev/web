<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once "conexion.php";
session_start();
$conn = new CConexion;
$conex = $conn->conexiondb();

try{
	$usuario = $_POST['usuario_cuenta'];
	$clave = $_POST['contrasena'];
	$stmt = $conex->prepare("select * from usuario where usuario_cuenta = :usuario");
	$stmt->bindParam(':usuario', $usuario);
	$stmt->execute();
	
	if($stmt->rowCount() > 0){
		$users = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(password_verify($clave, $users['contrasena'])){
			$_SESSION['username'] = $users['usuario_cuenta']; 
			$_SESSION['rol'] = $users['rol_user']; 
			$_SESSION['id'] = $users['id'];
			$_SESSION['last_activity'] = time();
			header('Location: index.php');
			exit();
		}else{
			echo "Contrasena incorrecta";
			echo "</br></br><a href='inicio_de_sesion.php'>Volver a ingresar usuario</a>";
		}
	}else{
		echo "Usuario no encontrado";
		echo "</br></br><a href='inicio_de_sesion.php'>Volver a ingresar usuario</a>";
	}
	
}
catch(exception $e){
	echo "Error" .  $e->getMessage();
}

?>
