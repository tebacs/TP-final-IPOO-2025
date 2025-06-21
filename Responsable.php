<?php
    include_once 'BaseDatos.php';

    class Responsable extends Persona {
        
        //ATRIBUTOS - VARIABLES INSTANCIA
        private $numeroResponsable;
        private $numeroLicencia;

        //METODO CONSTRUCTOR
        public function __construct($nombre, $apellido, $numeroLicencia){
            parent::__construct($nombre, $apellido);
            $this -> numeroResponsable = 0;
            $this -> numeroLicencia = $numeroLicencia;
            
        }

        //METODOS DE ACCESO GET Y SET
        public function getNumeroResponsable() {
            return $this->numeroResponsable;
        }
        public function setNumeroResponsable($numeroResponsable){
            $this -> numeroResponsable = $numeroResponsable;
        }

        public function getNumeroLicencia() {
            return $this->numeroLicencia;
        }
        public function setNumeroLicencia($numeroLicencia) {
            $this->numeroLicencia = $numeroLicencia;
        }


        public function __toString() {
            $mensaje = parent::__toString();
            $mensaje .= "Id Responsable: " . $this -> getNumeroResponsable() . "\n";
            $mensaje .= "Licencia: " . $this -> getNumeroLicencia() . "\n";

            return $mensaje;
        }

        /**
	 * Recupera los datos de una persona por numero de idPersona
	 * @param int $idPersona
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($numeroResponsable){
		$base=new BaseDatos();
		$consultaPersona="SELECT * FROM Responsable WHERE numeroResponsable=". $numeroResponsable;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($fila=$base->Registro()){
                    $this->setNumeroResponsable($fila['numeroResponsable']);					
					$this->setNumeroLicencia($fila['numeroLicencia']);
					
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
		$consultaPersonas="SELECT * FROM Responsable ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' WHERE '.$condicion;
		}
		$consultaPersonas.=" order by numeroResponsable ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($fila=$base->Registro()){
				
					$responsable = new Responsable($fila['nombre'], $fila['apellido'], $fila['numeroLicencia']);	
					array_push($arregloPersona,$responsable);
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
		$consultaInsertar="INSERT INTO Responsable(numeroResponsable, idPersona, numeroLicencia) 
			VALUES (".$this->getNumeroResponsable(). "','".parent::getIdPersona(). "','" .$this->getNumeroLicencia() ."')";
		
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
	    $resp = false; 
	    $base = new BaseDatos();
		$consultaModifica="UPDATE Responsable SET numeroResponsable='".$this->getNumeroResponsable()."', idPersona='". parent::getIdPersona()."', numeroLicencia='".$this->getNumeroLicencia()."' WHERE idPersona=". parent::getIdPersona();
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
				$consultaBorra="DELETE FROM Responsable WHERE idPersona=". parent::getIdPersona();
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