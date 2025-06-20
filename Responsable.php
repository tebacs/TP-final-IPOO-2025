<?php
    include_once 'BaseDatos.php';

    class Responsable extends Persona {
        
        private static $contadorResp = 1;
        //ATRIBUTOS - VARIABLES INSTANCIA
        private $numeroResponsable;
        private $numeroLicencia;

        //METODO CONSTRUCTOR
        public function __construct($dni, $nombre, $apellido, $numeroLicencia){
            parent::__construct($dni, $nombre, $apellido);
            $this -> numeroResponsable = self::$contadorResp;
            self::$contadorResp++;
            $this -> numeroLicencia = $numeroLicencia;
           
        }

        //METODOS DE ACCESO GET Y SET
        public function getNumeroResponsable() {
            return $this->numeroResponsable;
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

    }



?>