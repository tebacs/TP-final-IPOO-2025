<?php
    include_once 'BaseDatos.php';

    class Viaje{
        private $idViaje=0;
        private $destino;
        private $idEmpresa;
        private $colPasajeros;
        private $refResponsableV;
        private $cantMaxPasajeros;
        private $importeViaje;

        //Constructor
        public function __construct($empresa,$responsable,$dest,$maxPasaj,$importe){
            $this->destino=$dest;
            $this->idEmpresa=$empresa;
            $this->colPasajeros=[];
            $this->refResponsableV=$responsable;
            $this->cantMaxPasajeros=$maxPasaj;
            $this->importeViaje=$importe;
        }

        //Getters y Setters
        public function getIdViaje(){
            return $this->idViaje;
        }

        public function setIdViaje($nuevo){
            $this->idViaje=$nuevo;
        }

        public function getDestino(){
            return $this->destino;
        }

        public function setDestino($nuevo){
            $this->destino=$nuevo;
        }

        public function getIdEmpresa(){
            return $this->idEmpresa;
        }


        public function getPasajeros(){
            return $this->colPasajeros;
        }

        public function setPasajeros($nuevo){
            $this->colPasajeros=$nuevo;
        }

        public function getResponsableV(){
            return $this->refResponsableV;
        }

        public function setResponsableV($nuevo){
            $this->refResponsableV=$nuevo;
        }

        public function getMaxPasajeros(){
            return $this->cantMaxPasajeros;
        }

        public function setMaxPasajeros($nuevo){
            $this->cantMaxPasajeros=$nuevo;
        }

        public function getImporte(){
            return $this->importeViaje;
        }

        public function setImporte($nuevo){
            $this->importeViaje=$nuevo;
        }

        public function __tostring(){
            $mensj= "El viaje " . $this->getIdViaje() ." con destino a " . $this->getDestino(). "\nLo realiza la empresa: " . $this->getIdEmpresa()->__toString() .
             "\nCon un máximo de " . $this->getMaxPasajeros(). " pasajeros.\nSu responsable es " . $this->getResponsableV()->__toString() . "\nTiene un importe $" . $this->getImporte();
            $cantPasajeros= count($this->getPasajeros());
            $i=0;

            for($i=0; $i<$cantPasajeros; $i++){
                $mensj .= "\nPasajero:\n-" . $this->getPasajeros()[$i]->__toString();
            }
            return $mensj;
        }

        /**
         * Recupera los datos de un viaje segun su id
         * @param int $id idViaje
         * @throws \Exception
         * @return bool true de haberlo encontrado, false caso contrario
         */
        public static function Buscar($id){
            $base= new BaseDatos();
            $consultaViaje= "Select * from Viaje where idViaje= '" . $id . "'";
            $resp= false;

            if($base->iniciar()){
                if($base->Ejecutar($consultaViaje)){
                    if($fila=$base->Registro()){
                        $viajeEncontrado= new Viaje(
                             $fila['idEmpresa'], $fila['responsableV'],
                    $fila['destino'], $fila['cantMaxPasajeros'], $fila['importeViaje']
                        );
                         $viajeEncontrado->setIdViaje($id);
                        $resp=true;
                    }
                } else{
                    throw new Exception($base->getError());
                }
            } else{
                throw new Exception($base->getError());
            }
            return $resp;
        }

        /**
         * Recupera los datos de los viajes, ordenado según su destino
         * @param mixed $condicion
         * @throws \Exception
         * @return bool
         */
        public static function Listar($condicion=''){
            $aViaje= null; //Arreglo de los viajes si se puede ejecutar la consulta
            $base= new BaseDatos();
            $consultaListar= "Select * from Viaje ";
            if($condicion!=''){
                $consultaListar .= "where " . $condicion;
            }
            $consultaListar .= " order by Destino";

            if($base->iniciar()){
                if($base->Ejecutar($consultaListar)){
                    while($fila=$base->Registro()){
                        $objViaje= new Viaje(
                            $fila['idEmpresa'], $fila['responsableV'], $fila['destino'], $fila['cantMaxPasajeros'], $fila['importeViaje']
                        );
                        $objViaje->setIdViaje($fila['idViaje']);
                        $aViaje[]=$objViaje;
                    }
                }else{
                    throw new Exception($base->getError());
                }
            }else{
                throw new Exception($base->getError());
            }
            return $aViaje;
        }

        public function Insertar(){
            $base= new BaseDatos();
            $resp= false;
            $consulta= "INSERT INTO Viaje( destinoViaje, cantMaxPasajeros, idEmpresa, numeroResponsableViaje, importeViaje) 
                        VALUES ('". $this->getDestino() . "', '" .  $this->getMaxPasajeros() . "', '" . $this->getIdEmpresa()
                        . "', '" . $this->getResponsableV()->getNumeroResponsable() . "', '" . $this->getImporte() . "')";
            
            if($base->iniciar()){
                if($id=$base->devuelveIDInsercion($consulta)){
                    $this->setIdViaje($id);
                    $resp= true;
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
            $resp=false;
            $consulta= "UPDATE Viaje SET destinoViaje= '" . $this->getDestino() . "', idEmpresa= '" . $this->getIdEmpresa()
                        . "', numeroResponsableViaje= '" . $this->getResponsableV()->getNumeroResponsable() . "', importeViaje= '" . $this->getImporte() 
                        . "' WHERE idViaje= '" . $this->getIdViaje() . "'";
            
            if($base->iniciar()){
                if($base->Ejecutar($consulta)){
                    $resp= true;
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
                $consulta= "DELETE FROM Viaje WHERE idViaje= '" . $this->getIdViaje() . "'";
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