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

	public static function Buscar($id){
		$persona = Persona::Buscar($id);

		if($persona !== null){
			$base = new BaseDatos();
			$consultaPasajero="SELECT * FROM Pasajero WHERE idPersona=". $id . " AND borrado IS NULL";
			
			if($base->Iniciar()){
				if($base->Ejecutar($consultaPasajero)){
					
					if($fila=$base->Registro()){
						$pasajeroEncontrado=null;
						if (is_array($fila)) {
							$pasajeroEncontrado = new Pasajero($persona->getNombre(),
							$persona->getApellido(),
							$fila['documentoPasajero'],					
							$fila['telefonoPasajero']
							); 
							$pasajeroEncontrado->setIdPersona($id);
						}
								
					} else {
						throw new Exception("No se encontro el pasajero con id: " . $id);
					}
				
				}	else {
						throw new Exception($base->getError());
					
				}
			}	else {
					throw new Exception($base->getError());
			}
		}else{
			$pasajeroEncontrado = null;
		}		
		 return $pasajeroEncontrado;
	}

     public static function Listar($condicion= ''){
	    $arregloPersona = null;
		$base = new BaseDatos();
		$consultaPersonas="SELECT * FROM Pasajero ";
		if ($condicion!= ''){
		    $consultaPersonas .= ' WHERE '. $condicion . "AND borrado IS NULL";
		} else {
			$consultaPersonas .= "WHERE borrado IS NULL";
		}
		$consultaPersonas .= " order by documentoPasajero ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				
				while($fila=$base->Registro()){
					$objPasajero = new Pasajero(
						$fila['nombre'],
						$fila['apellido'],
						$fila['documentoPasajero'],
						$fila['telefonoPasajero']
					);
					$objPasajero -> setIdPersona($fila['idPersona']);
					$arregloPersona[] =$objPasajero;
				}
		 	}	else {
		 			throw new Exception($base->getError());	
			}
		} else {
		 	throw new Exception($base->getError());	
		}	
		return $arregloPersona;
	}	

    public function Insertar(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO Pasajero(documentoPasajero, telefonoPasajero, idPersona) 
				VALUES (".$this->getDocumentoPasajero(). "','".$this->getTelefonoPasajero(). "','" . parent::getIdPersona()."')";
		
		if($base->Iniciar()){
			if($id=$base->devuelveIDInsercion($consultaInsertar)){
			    $this -> setIdPersona($id);
				$resp=  true;
			} else {
					throw new Exception($base->getError());	
			    }
		} else {
			throw new Exception($base->getError());
		}
		return $resp;
	}

    public function Modificar(){
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

    public function Eliminar(){
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()){
				$consultaBorra="UPDATE Pasajero SET borrado = CURRENT_DATE WHERE idPersona=". parent::getIdPersona();
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