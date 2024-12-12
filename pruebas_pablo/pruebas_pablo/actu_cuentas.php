<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "conexion.php";

$conn = new CConexion;
$conex = $conn->conexiondb();

$usuario = $_POST['user'];
$cargo = $_POST['cargo'];

try{
	
	$query = "update usuario set rol_user=:cargo where usuario_cuenta=:usuario";
	
	$stmt = $conex->prepare($query);
	$stmt->bindParam(':cargo', $cargo);
	$stmt->bindParam(':usuario', $usuario);
	
	if($stmt->execute()){
		header('Location: admin_cuentas.php');
		exit();
	}else{
		echo $usuario . "  " . $cargo;
		echo "Error al crear el registro";
	}
}
catch(exception $e){
	echo "Error al actualizar el salario: " . $e->getMessage();
}
?>

