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

	 public static function Buscar($id){
            $base= new BaseDatos();
            $consulta= "SELECT * FROM Persona WHERE idPersona= '" . $id . "'AND borrado IS NULL";
			$personaEncontrada = null;

            if($base->iniciar()){
                if($base->Ejecutar($consulta)){
                    if($fila=$base->Registro()){
						if (is_array($fila)) {
							$personaEncontrada= new Persona(
                            $fila['nombre'],
                            $fila['apellido']
                        );
						 $personaEncontrada->setIdPersona($id);
						}   
                    } else {
						throw new Exception("No se encontró la Persona con ID: " . $id);
					}
                } else{
                    throw new Exception($base->getError());
                }
            } else{
                throw new Exception($base->getError());
            }
            return $personaEncontrada;
        }

    public static function listar($condicion=""){
	    $arregloPersona = null;
		$base = new BaseDatos();
		$consultaPersonas="SELECT * FROM Persona ";
		if ($condicion!=""){
		    $consultaPersonas .= " WHERE " . $condicion . " AND borrado IS NULL";
		} else {
			$consultaPersonas .= " WHERE borrado IS NULL";
		}
		$consultaPersonas.=" order by apellido ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				while($fila=$base->Registro()){
					$objPersona = new Persona(
						$fila['nombre'],
						$fila['apellido']
					);
					$objPersona -> setIdPersona($fila['idPersona']);
					$arregloPersona[] = $objPersona;
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
		$base = new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO persona(nombre, apellido) 
				VALUES ('".$this->getNombre()."','".$this->getApellido()."')";
		
		if($base->Iniciar()){
			if($id = $base->devuelveIDInsercion($consultaInsertar)){
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
	    $base = new BaseDatos();
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
				$consulta="UPDATE Persona SET borrado = CURRENT_DATE WHERE idPersona=" . $this->getIdPersona();
				if($base->Ejecutar($consulta)){
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