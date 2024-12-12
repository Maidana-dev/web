<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "conexion.php";
$con = new CConexion;
$conex = $con->conexiondb();

$dni = intval($_POST['dni']);

try{
	$query = "DELETE from planilla where dni=:dni";
	$stmt = $conex->prepare($query);
	$stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
	
	if($stmt->execute()){
		header('Location: despedir_empleado.php');
		exit();
	}else{
		echo "no se pudo eliminar al empleado";
	}
}
catch(exception $e){
	echo "Error " . $e->getMessage();
}

?>
