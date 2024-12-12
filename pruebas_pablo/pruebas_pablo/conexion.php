<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);	
class CConexion{
	private $dbprueba;
	public function conexiondb(){
		$host = "localhost";
		$puerto = 5432;
		$dbname = "postgres";
		$username = "postgres";
		$password = "12345678";
		
		try{
			
			$con = "pgsql:host=$host;port=$puerto;dbname=$dbname";
			$this->setdataBase(new PDO($con, $username, $password));
			$this->getdataBase()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->getdataBase()->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			//echo "Conexion exitosa";
			return $this->getdataBase();
			
			}
		catch(Exception $e){
			echo $e->getMessage();
			return null;
			}
	}
	
	private function setdataBase($p_bsData){
		$this->dbprueba = $p_bsData;
	}

	public function getdataBase(){
		return $this->dbprueba;
	}
	/*public function getConn(){
		return $dbprueba;
	}
	
	public function close(){
		dbprueba = null;
	}*/
}

?>
