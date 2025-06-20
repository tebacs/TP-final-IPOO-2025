<?php
include_once 'BaseDatos.php';
//Clase Pasajero que hereda de Persona
class Pasajero extends Persona {

    //ATRIBUTOS Y VARIABLES INSTANCIA
    private $documentoPasajero;
    private $telefonoPasajero;

    //METODO CONSTRUCTOR
    public function __construct($nombre, $apellido, $documentoPasajero, $telefonoPasajero) {
        parent::__construct($nombre, $apellido);
        $this->documentoPasajero = $documentoPasajero;
        $this->telefonoPasajero = $telefonoPasajero;
    }   

    //METODOS DE ACCESO GETTERS Y SETTERS
    public function getDocumentoPasajero() {
        return $this->documentoPasajero;
    }
    public function setDocumentoPasajero($documentoPasajero) {
        $this->documentoPasajero = $documentoPasajero;
    }
    public function getTelefonoPasajero() {
        return $this->telefonoPasajero;
    }
    public function setTelefonoPasajero($telefonoPasajero) {
        $this->telefonoPasajero = $telefonoPasajero;
    }
    public function __toString() {
        $mensaje = parent::__toString();
        $mensaje .= "Documento Pasajero: " . $this->getDocumentoPasajero() . "\n";
        $mensaje .= "Telefono Pasajero: " . $this->getTelefonoPasajero() . "\n";

        return $mensaje;
    }

    /**
	 * Recupera los datos de una persona por numero de idPersona
	 * @param int $idPersona
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($documentoPasajero){
		$base=new BaseDatos();
		$consultaPersona="SELECT * from Pasajero WHERE documentoPasajero=" . $documentoPasajero;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($fila=$base->Registro()){
                    $this->setDocumentoPasajero($fila['documentoPasajero']);					
					$this->setTelefonoPasajero($fila['telefonoPasajero']);
					
					$resp= true;
				}				
			
		 	}	else {
		 			throw new Exception($base->getError());
		 		
			}
		 }	else {
		 		throw new Exception($base->getError());
		 	
		 }		
		 return $resp;
	}

     public static function listar($condicion=""){
	    $arregloPersona = null;
		$base=new BaseDatos();
		$consultaPersonas="SELECT * FROM Pasajero ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' WHERE '.$condicion;
		}
		$consultaPersonas.=" order by documentoPasajero ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($fila=$base->Registro()){
				
					$pasajero=new Pasajero($fila['nombre'], $fila['apellido'], $fila['documentoPasajero'], $fila['telefonoPasajero']);	
					array_push($arregloPersona,$pasajero);
				}
		 	}	else {
		 			throw new Exception($base->getError());	
			}
		} else {
		 	throw new Exception($base->getError());	
		}	
		return $arregloPersona;
	}	

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO Pasajero(documentoPasajero, telefonoPasajero, idPersona) 
				VALUES (".$this->getDocumentoPasajero(). "','".$this->getTelefonoPasajero(). "','" . parent::getIdPersona()."')";
		
		if($base->Iniciar()){
			if($id=$base->devuelveIDInsercion($consultaInsertar)){
			    $resp=  true;
			} else {
					throw new Exception($base->getError());	
			    }
		} else {
			throw new Exception($base->getError());
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE Pasajero SET documentoPasajero='".$this->getDocumentoPasajero()."',telefonoPasajero='".$this->getTelefonoPasajero()."',idPersona='". parent::getIdPersona()."' WHERE idPersona=". parent::getIdPersona();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				throw new Exception($base->getError());	
			}
		}else{
				throw new Exception($base->getError());
		    }
		return $resp;
	}

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM Pasajero WHERE idPersona=". parent::getIdPersona();
				if($base->Ejecutar($consultaBorra)){
				    $resp= true;
				}else{
					throw new Exception($base->getError());
				}
		}else{
			throw new Exception($base->getError());
		}
		return $resp; 
	}

    
}

?>