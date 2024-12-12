<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include_once "conexion.php";
$con = new CConexion;
$conex = $con->conexiondb();

$nombre = $_POST['nombre'];
$dni = intval($_POST['dni']);
$salario = floatval($_POST['salario']);

if(empty($_POST['nombre'])){
	die("Error el campo nombre esta vacio");
}

try {
	$stmt = $conex->prepare("insert into planilla (nombre, dni, salario) values(:nombre, :dni, :salario)");
	$stmt->bindParam(':nombre', $nombre);
	$stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
	$stmt->bindParam(':salario', $salario, PDO::PARAM_STR);
	
	if($stmt->execute()){
		header('Location: formularios.php');
		exit();
	}else{
		echo "Error al crear el registro";
		echo "</br><a href='index.php'>volver</a></br>";
	}
	
}
catch(Exception $e){
		echo "Error: " . $e->getMessage();
	}


		
//$con->close();
echo "Conexion cerrada<br>";
?>
