<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



include_once "conexion.php";
$conn = new CConexion;
$conex = $conn->conexiondb();

$usuario = $_POST['usuario_cuenta'];
$clave = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$email = $_POST['correo'];
$telefono = $_POST['telefono'];
$rol_user = "public";

try{
	if(empty($_POST['telefono'])){
		$query = "insert into usuario (usuario_cuenta, contrasena, email, rol_user) values(:name, :clave, :email, :rol_user)";
		$stmt = $conex->prepare($query);
	}else{
		$query = "insert into usuario (usuario_cuenta, contrasena, email, telefono, rol_user) values(:name, :clave, :email), :telefono, :rol_user";
		$stmt = $conex->prepare($query);
		$stmt->bindParam(':telefono', $telefono, PDO::PARAM_INT);
	}
	
	$stmt->bindParam(':name', $usuario);
	$stmt->bindParam(':clave', $clave);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':rol_user', $rol_user);
	
	
	if($stmt->execute()){
		header('Location: inicio_de_sesion.php');
		exit();
	}else{
		echo "ERROR AL REGISTRAR EL USUARIO";
		print_r($stmt->errorInfo());
	}
}
catch(exception $e){
	echo "Error" . $e->getMessage();
}
?>
