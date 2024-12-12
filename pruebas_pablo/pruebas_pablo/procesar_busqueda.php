<?php
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				
				include_once "conexion.php";
				$conex = new CConexion;
				$con = $conex->conexiondb();
			
				$buscar = $_POST['buscador'];
				try{
					$query = "select * from planilla where nombre like :busqueda";
					$stmt = $con->prepare($query);
					$otroBuscar = "%$buscar%";
					$stmt->bindParam(':busqueda', $otroBuscar, PDO::PARAM_STR);
					
					$stmt->execute();
					
					
					
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					
					if($result){
						echo "<h2>Resultados de la busqueda:</h2>";
						
						echo "<table border='1'>
								<tr>
									<th>Nombre</th>
									<th>DNI</th>
									<th>Salario</th>
								</tr>";
						
						foreach($result as $row){
							echo "<tr> 
								<td>" . htmlspecialchars($row['nombre']) ."</td>
								<td>" . htmlspecialchars($row['dni']) ."</td>
								<td>" . htmlspecialchars($row['salario']) . "</td>
							</tr>
							";
						}
						echo "</table>";
					}else{
						echo "No records found.";
					}
					
				}
				catch(Exception $e){
					echo "Error: " . $e->getMessage();
				}
			}
			?>
