<?php
/*session_start();

$timeout_duracion = 1800;

if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duracion) {
	
	header('Location: cerrar_sesion.php');
	exit();
}

$_SESSION['last_activity'] = time();

if(!isset($_SESSION['username'])){
	header('Location: inicio_de_sesion.php');
	exit();
}*/
?>

<!DOCTYPE html>
<html lang = "es">
	<head>
		<title>Pagina de Registros</title>
	</head>
	<body>
		<h2>Registros de empleados</h2>
		<?php
			include_once "conexion.php";
			$conex = new CConexion;
			$con = $conex->conexiondb();

			try{
				$query = "select * from planilla";
				$stmt = $con->prepare($query);
				$stmt->execute();
	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
				if($result){
					foreach($result as $row){
					echo "</br>Nombre: {$row['nombre']} | DNI: {$row['dni']} | Salario: {$row['salario']}</br>";
					}
				}else{
					echo "No records found.";
				}
			}
			catch(Exception $e){
				echo "Error: " . $e->getMessage();
			}
		?>
		</br>
			
	</body>
</html>



