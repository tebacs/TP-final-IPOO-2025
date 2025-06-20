<?php
    include_once 'BaseDatos.php';

    class Responsable extends Persona {
        
        //ATRIBUTOS - VARIABLES INSTANCIA
        private $numeroResponsable;
        private $numeroLicencia;
        private static $contadorResp = 1;

        //METODO CONSTRUCTOR
        public function __construct($idPersona, $nombre, $apellido, $numeroLicencia){
            parent::__construct($idPersona, $nombre, $apellido);
            $this -> numeroResponsable = self::$contadorResp;
            $this -> numeroLicencia = $numeroLicencia;
            self::$contadorResp++;
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