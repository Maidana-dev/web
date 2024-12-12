<?php
//session_start();
class traer_mensajes{
    private $id_destinatario;
    private $id_remitente;

    public function __construct($p_dest, $p_remit)
    {
        $this->setIdDestinatario($p_dest);
        $this->setIdRemitente($p_remit);
    }

    public function getIdDestinatario(){
        return $this->id_destinatario;
    }

    public function getIdRemitente(){
        return $this->id_remitente;
    }

    private function setIdDestinatario($p_dest){
        $this->id_destinatario = $p_dest;
    }

    private function setIdRemitente($p_remit){
        $this->id_remitente = $p_remit;
    }

    private function traerMensajes(){
        include_once "conexion.php";
	    $conex = new CConexion;
	    $con = $conex->conexiondb();
        try{
            $query = "select usuario.usuario_cuenta AS remitente, mensaje.mensaje, mensaje.fecha FROM mensaje 
                JOIN usuario ON mensaje.id_remitente = usuario.id 
                WHERE mensaje.id_destinatario = :id_dest and mensaje.id_remitente = :id_remit or mensaje.id_destinatario = :id_remit and mensaje.id_remitente = :id_dest
                ORDER BY mensaje.fecha asc";
		    $stmt = $con->prepare($query);

            $variable_remit = $this->getIdRemitente();
            $variable_dest = $this->getIdDestinatario();

		    $stmt->bindParam(':id_remit', $variable_remit);
		    $stmt->bindParam(':id_dest', $variable_dest);

		    $stmt->execute();
            return $stmt;
        }
        catch(Exception $e){
            echo "Error de" . $e->getMessage();
        }
    }

    public function mostrarMensajes(){
        $stmt = $this->traerMensajes();
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['remitente'] == $this->getIdRemitente()){
                    echo  "<p class='mensaje2'>". htmlspecialchars($row['remitente']) . "</br>" .  htmlspecialchars($row['mensaje']) . "<small>" . "</br>" .  htmlspecialchars($row['fecha']) . "</small></p></br>";  
                }else{
                    echo  "<p class='mensaje'>". $row['remitente'] . "</br>" . $row['mensaje'] . "<small>" . "</br>" . $row['fecha'] . "</small></p></br>";  
                }
                
            }
        }else{
            echo "no hay mensajes";
        }
        
    }
}

?>