<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
				
	include_once "conexion.php";
	$conex = new CConexion;
	$con = $conex->conexiondb();
	
	$id_remitente = $_SESSION['id'];
	$id_destinatario = $_POST['destinatario'];
	echo "el id remitente es es " . $_SESSION['id'];
	echo "el id destinatario es " . $_POST['destinatario'];
	echo "el mensaje es " . $_POST['message'];
	$mensage = $_POST['message'];

	try{
		$query = "insert into mensaje (id_remitente, id_destinatario, mensaje) values(:id_remit, :id_dest, :mensaje)";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':id_remit', $id_remitente);
		$stmt->bindParam(':id_dest', $id_destinatario);
		$stmt->bindParam(':mensaje', $mensage);

		if($stmt->execute()){
			$_SESSION['id_destino'] = $id_destinatario;
			header('Location: chat.php');
			exit();
		}

	}
	catch(Exception $e){
		echo "Error de" . $e->getMessage();
	}
}
?>
