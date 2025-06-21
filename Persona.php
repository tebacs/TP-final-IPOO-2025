<?php
    include_once 'BaseDatos.php';
    //Clase Abstracta o Padre de class Cliente
    class Persona {
        //ATRIBUTOS
        private $idPersona;
        private $nombre;
        private $apellido;

        //METODO CONSTRUCTOR
        public function __construct($nombre, $apellido) {
            $this -> idPersona = 0;
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
        }

        //METODOS DE ACCESO 
        public function getIdPersona(){
            return $this->idPersona;
        }

        public function setIdPersona($idPersona){
            $this -> idPersona = $idPersona;
        }

        public function getNombre(){
            return $this -> nombre;
        }

        public function SetNombre($nombre){
            $this -> nombre = $nombre;
        }

        public function getApellido(){
            return $this -> apellido;
        }

        public function setApellido($apellido){
            $this -> apellido = $apellido;
        }

        public function __toString(){
            
            $mensaje = "\n--------------DATOS----------------------\n";
            $mensaje .= "Nombre: " . $this -> getNombre() . "\n";
            $mensaje .= "Apellido: " . $this -> getApellido() . "\n";
            $mensaje .= "idPersona: " . $this -> getidPersona() . "\n";

            return $mensaje;
        }

    /**
	 * Recupera los datos de una persona por numero de idPersona
	 * @param int $idPersona
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idPersona){
		$base=new BaseDatos();
		$consultaPersona="SELECT * FROM Persona WHERE idPersona=".$idPersona;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($fila=$base->Registro()){
                    $this->setIdPersona($fila['idPersona']);					
					$this->setNombre($fila['nombre']);
					$this->setApellido($fila['apellido']);
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
		$consultaPersonas="SELECT * FROM Persona ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' WHERE '.$condicion;
		}
		$consultaPersonas.=" order by apellido ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($fila=$base->Registro()){
				
					$persona=new Persona($fila['nombre'], $fila['apellido']);
					Persona::setIdPersona($fila['idPersona']);/* HABLARLO CON LOS CHICOS */
					array_push($arregloPersona,$persona);
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
		$consultaInsertar="INSERT INTO persona(nombre, apellido) 
				VALUES (".$this->getNombre()."','".$this->getApellido()."')";
		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaInsertar)){
			    $resp=  true;

			}	else {
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
		$consultaModifica="UPDATE Persona SET idPersona='".$this->getIdPersona()."',nombre='".$this->getNombre()."',apellido='".$this->getApellido()."' WHERE idPersona=". $this->getIdPersona();
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
				$consultaBorra="DELETE FROM Persona WHERE idPersona=".$this->getIdPersona();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
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