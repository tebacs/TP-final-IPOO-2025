<?php
    include_once 'BaseDatos.php';

    class Viaje{
        private $idViaje;
        private $destino;
        private $idEmpresa;
        private $colPasajeros;
        private $refResponsableV;
        private $cantMaxPasajeros;
        private $importeViaje;
        private $contadorId;

        //Constructor
        public function __construct($empresa,$responsable,$dest,$maxPasaj,$importe){
            self::$contadorId=1;
            $this->idViaje= self::$contadorId;
            $this->destino=$dest;
            $this->idEmpresa=$empresa;
            $this->colPasajeros=[];
            $this->refResponsableV=$responsable;
            $this->cantMaxPasajeros=$maxPasaj;
            $this->importeViaje=$importe;
            self:: $contadorId++;
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

        public function setIdEmpresa($nuevo){
            $this->idEmpresa=$nuevo;
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

        public function setResponsableB($nuevo){
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
                $mensj .= "\nPasajero:\n-" . $this->getPasajeros()->__toString();
            }
            return $mensj;
        }
    }
?>