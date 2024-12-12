<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "conexion.php";

$conn = new CConexion;
$conex = $conn->conexiondb();

$dni = intval($_POST['dni']);
$new_salario = floatval($_POST['salario']);

try{
	
	$query = "update planilla set salario=:salario where dni=:dni";
	
	$stmt = $conex->prepare($query);
	$stmt->bindParam(':salario', $new_salario, PDO::PARAM_STR );
	$stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
	
	if($stmt->execute()){
		header('Location: cambiar_registro.php');
		exit();
	}else{
		echo "Error al crear el registro";
	}
}
catch(exception $e){
	echo "Error al actualizar el salario: " . $e->getMessage();
}
?>
