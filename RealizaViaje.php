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
        return "El pasajero " . $this->getIdPasajero()->__toString() . " realiza el viaje " . $this->getIdViaje()->__toString();
    }

    public function Buscar($pasajero, $viaje){
        $base= new BaseDatos();
        $resp=false;
        $condicion= "Select * from RealizaViaje WHERE idViaje= ". $viaje . ", idPasajero= " . $pasajero;

        if($base->iniciar()){
            if($base->Ejecutar($condicion)){
                if($fila= $base->Registro()){
                    $realizaViajeEncontrado= new RealizaViaje(
                        $fila['idViaje'], $fila['idPasajero'] , $fila['fecha']
                    );
                    $resp=true;
                }
            }else{
                throw new Exception($base->getError());
            }
        }else{
            throw new Exception($base->getError());
        }

        return $resp;
    }

    /**
     * Recupera los RealizaViaje y los ordena segun su viaje y su pasajero
     * @param mixed $condicion
     * @throws \Exception
     * @return RealizaViaje[]
     */
    public function Listar($condicion=''){
        $aRealizaViaje=null; //Arreglo de RealizaViaje si se ejecuta la consulta
        $base= new BaseDatos();
        $consulta="Select * from RealizaViaje";
        if($condicion!=''){
            $consulta .= " WHERE ". $condicion;
        }
        $consulta .= " order by idViaje, idPasajero";

        if($base->iniciar()){
            if($base->Ejecutar($consulta)){
                $aRealizaViaje=[];
                while($fila= $base->Registro()){
                    $objRealizaViaje= new RealizaViaje(
                        $fila['idViaje'], $fila['idPasajero'] , $fila['fecha']
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
        $consulta= "INSERT INTO RealizarViaje (idViaje, idPasajero, fecha) VALUES (" . $this->getIdViaje() . ", " . $this->getIdPasajero() . ", " . $this->getFecha() . ")";

        if($base->iniciar()){
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
        $consulta= "UPDATE RealizaViaje SET idViaje= " . $this->getIdViaje() . ", idPasajero= " . $this->getIdPasajero() . ", fecha= " . $this->getFecha() . " WHERE idViaje= " . $this->getIdViaje() . ", idPasajero= " . $this->getIdPasajero();

        if($base->iniciar()){
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

        if($base->iniciar()){
            $consulta= "DELETE FROM RealizaViaje WHERE idViaje=" . $this->getIdViaje() . ", idPasajero= " . $this->getIdViaje();
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