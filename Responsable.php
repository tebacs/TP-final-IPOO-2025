<?php
    include_once 'BaseDatos.php';

    class Responsable {
        private static $contadorResp = 1;
        //ATRIBUTOS - VARIABLES INSTANCIA
        private $numeroResponsable;
        private $numeroLicencia;
        private $nombreResponsable;
        private $apellidoResponsable;

        //METODO CONSTRUCTOR
        public function __construct($numeroLicencia, $nombreResponsable, $apellidoResponsable){
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
            $mensaje = "\n-------------Responsable-------------\n";
            $mensaje .= "Id Responsable: " . $this -> getNumeroResponsable() . "\n";
            $mensaje .= "Licencia: " . $this -> getNumeroLicencia() . "\n";
            $mensaje .= "Nombre: " . $this -> getNombreResponsable() . "\n";
            $mensaje .= "Apellido: " . $this -> getApellidoResponsable() . "\n";

            return $mensaje;
        }

    }



?>