<?php
include_once 'BaseDatos.php';
class RealizaViaje{
    private $idViaje;
    private $idPasajero;
    private $fecha;
    
    public function __construct($viaje,$pasajero,$fecha){
        $this->idPasajero=$pasajero;
        $this->idViaje=$viaje;
        $this->fecha=$fecha;
    }

    public function getIdViaje(){
        return $this->idViaje;
    }

    public function setIdViaje($nuevo){
        $this->idViaje=$nuevo;
    }

    public function getIdPasajero(){
        return $this->idPasajero;
    }

    public function setIdPasajero($nuevo){
        $this->idPasajero=$nuevo;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($nuevo){
        $this->fecha=$nuevo;
    }

    public function __tostring(){
        return "El pasajero " . $this->getIdPasajero() . " realiza el viaje " . $this->getIdViaje();
    }

    public static function Buscar($pasajero, $viaje){
        $base= new BaseDatos();
        $realizaViajeEncontrado=null;
        $condicion= "SELECT * FROM RealizaViaje WHERE idViaje= ". $viaje . " AND idPasajero= " . $pasajero;

        if($base->Iniciar()){
            if($base->Ejecutar($condicion)){
                if($fila= $base->Registro()){
                    $realizaViajeEncontrado= new RealizaViaje(
                        $fila['idViaje'], $fila['idPasajero'] , $fila['fechaRealizaViaje']
                    );
                }
            }else{
                throw new Exception($base->getError());
            }
        }else{
            throw new Exception($base->getError());
        }

        return $realizaViajeEncontrado;
    }

    /**
     * Recupera los RealizaViaje y los ordena segun su viaje y su pasajero
     * param mixed $condicion
     * throws \Exception
     * return RealizaViaje[]
     */
    public static function Listar($condicion=''){
        $aRealizaViaje=null; //Arreglo de RealizaViaje si se ejecuta la consulta
        $base= new BaseDatos();
        $consulta="Select * from RealizaViaje";
        if($condicion!=''){
            $consulta .= " WHERE ". $condicion. " AND borrado IS NULL";
        }else{
            $consulta.= " WHERE borrado IS NULL";
        }
        $consulta .= " order by idViaje, idPasajero";

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $aRealizaViaje=[];
                while($fila= $base->Registro()){
                    $objRealizaViaje= new RealizaViaje(
                        $fila['idViaje'], $fila['idPasajero'] , $fila['fechaRealizaViaje']
                    );
                    $aRealizaViaje[]=$objRealizaViaje;
                }
            }else{
                throw new Exception(($base->getError()));
            }
        }else{
            throw new Exception($base->getError());
        }
        return $aRealizaViaje;
    }

    public function Insertar(){
        $base= new BaseDatos();
        $resp= false;
        $consulta= "INSERT INTO RealizaViaje (idViaje, idPasajero, fechaRealizaViaje) VALUES ('" . $this->getIdViaje() . "', '" . $this->getIdPasajero() . "', '" . $this->getFecha() . "')";

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $resp=true;
            }else{
                throw new Exception($base->getError());
            }
        }else{
            throw new Exception($base->getError());
        }

        return $resp;
    }

    public function Modificar(){
        $base= new BaseDatos();
        $resp= false;
        $consulta= "UPDATE RealizaViaje SET idViaje= '" . $this->getIdViaje() . "', idPasajero= '" . $this->getIdPasajero() . "', fechaRealizaViaje= '" . $this->getFecha() . "' WHERE idViaje= '" . $this->getIdViaje() . "', idPasajero= '" . $this->getIdPasajero()."'";

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $resp=true;
            }else{
                throw new Exception($base->getError());
            }
        }else{
            throw new Exception($base->getError());
        }
        return $resp;
    }

    public function Eliminar(){
        $base= new BaseDatos();
        $resp= false;

        if($base->Iniciar()){
            $consulta= "UPDATE RealizaViaje SET borrado = CURRENT_DATE WHERE idViaje= " . $this->getIdViaje() . " AND  idPasajero= " . $this->getIdViaje();
            if($base->Ejecutar($consulta)){
                $resp=true;
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