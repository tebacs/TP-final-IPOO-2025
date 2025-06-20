<?php
    include_once 'BaseDatos.php';

    class Responsable extends Persona {
        
        private static $contadorResp = 1;
        //ATRIBUTOS - VARIABLES INSTANCIA
        private $numeroResponsable;
        private $numeroLicencia;
        private $nombreResponsable;
        private $apellidoResponsable;

        //METODO CONSTRUCTOR
        public function __construct($dni, $nombre, $apellido, $numeroLicencia, $nombreResponsable, $apellidoResponsable){
            parent::__construct($dni, $nombre, $apellido);
            $this -> numeroResponsable = self::$contadorResp;
            self::$contadorResp++;
            $this -> numeroLicencia = $numeroLicencia;
            $this -> nombreResponsable = $nombreResponsable;
            $this -> apellidoResponsable = $apellidoResponsable;

        }

        //METODOS DE ACCESO GET Y SET
        public function getNumeroResponsable() {
            return $this->numeroResponsable;
        }
        public function getNumeroLicencia() {
            return $this->numeroLicencia;
        }
        public function getNombreResponsable() {
            return $this->nombreResponsable;
        }
        public function getApellidoResponsable() {
            return $this->apellidoResponsable;
        }
        public function setNumeroLicencia($numeroLicencia) {
            $this->numeroLicencia = $numeroLicencia;
        }
        public function setNombreResponsable($nombreResponsable) {
            $this->nombreResponsable = $nombreResponsable;
        }
        public function setApellidoResponsable($apellidoResponsable) {
            $this->apellidoResponsable = $apellidoResponsable;
        }

        public function __toString() {
            $mensaje = parent::__toString();
            $mensaje .= "Id Responsable: " . $this -> getNumeroResponsable() . "\n";
            $mensaje .= "Licencia: " . $this -> getNumeroLicencia() . "\n";
            $mensaje .= "Nombre: " . $this -> getNombreResponsable() . "\n";
            $mensaje .= "Apellido: " . $this -> getApellidoResponsable() . "\n";

            return $mensaje;
        }

    }



?>