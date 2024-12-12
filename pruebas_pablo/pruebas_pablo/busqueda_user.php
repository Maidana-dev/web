<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Busqueda{
	private $busqueda;

	public function __construct()
	{
		$this->setBusqueda();
	}

	public function getBusqueda(){
		return $this->busqueda;
	}

	private function setBusqueda(){
		if(isset($_POST['buscador'])){
			$this->busqueda = $_POST['buscador'];
		}else{
			$this->busqueda = null;
		}
		
	}

	private function buscarSolicitud(){
		include_once "conexion.php";
		$conex = new CConexion;
		$con = $conex->conexiondb();
				
		$buscar = $_POST['buscador'];
		try{
			$query = "select * from usuario where usuario_cuenta like :busqueda";
			$stmt = $con->prepare($query);
			$otroBuscar = "%$buscar%";
			$stmt->bindParam(':busqueda', $otroBuscar, PDO::PARAM_STR);
						
			$stmt->execute();
						
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
						
						
			if($result){
				//echo "<h2>Resultados de la busqueda:</h2>";
							
				echo "<table border='1' class='busqueda__tabla'>
						<tr>
						<th>Usuario</th>
						<th>Email</th>
						<th>Rol</th>
						<th>Contactar</th>
						</tr>";
							
				foreach($result as $row){
					echo "<tr> 
						<td>" . htmlspecialchars($row['usuario_cuenta']) ."</td>
						<td>" . htmlspecialchars($row['email']) . "</td>
						<td>" . htmlspecialchars($row['rol_user']) . "</td>
						<td>    <form action='chat.php' method='post'>
									<input type='hidden' name='usuario_cuenta' value=' ". htmlspecialchars($row['usuario_cuenta']) ."'>
									<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) ."'>
									<button type='submit'class='boton_mensaje'>Enviar Mensaje</button>					
								</form></td>
						</tr>";
				}
				echo "</table></br></br>";
			}else{
				echo "No records found.";
			}			
		}
		catch(Exception $e){
			echo "Error: " . $e->getMessage();
		}
	}

	private function busquedaPredeterminada(){
		include_once "conexion.php";
	$conex = new CConexion;
	$con = $conex->conexiondb();
	
		try{
			$query = "select * from usuario";
			$stmt = $con->prepare($query);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
			if($result){
				//echo "<h2>Resultados de la busqueda:</h2>";
						
				echo "<table border='1' class='busqueda__tabla'>
					<tr>
					<th>Usuario</th>
					<th>Email</th>
					<th>Rol</th>
					<th>Contactar</th>
					</tr>";
						
				foreach($result as $row){
					echo "<tr> 
					<td>" . htmlspecialchars($row['usuario_cuenta']) ."</td>
					<td>" . htmlspecialchars($row['email']) . "</td>
					<td>" . htmlspecialchars($row['rol_user']) . "</td>
					<td>" . '<form action="chat.php" method="post">
								<input type="hidden" name="id" value=" '. htmlspecialchars($row['id']) .'">
								<button type="submit">Enviar Mensaje</button>					
							</form>' . "</td>
					</tr></br></br>";
				}
				echo "</table></br></br>";
			}else{
				echo "No records found.";
			}
		}
		catch(Exception $e){
			echo "Error: " . $e->getMessage();
		}
	}

	public function ejecucion(){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$this->buscarSolicitud();
		}else{
			$this->busquedaPredeterminada();
		}
	}
}

?>
