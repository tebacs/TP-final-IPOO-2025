<?php
    include_once 'BaseDatos.php';

    class Empresa {
        //Variables insatancia - atributos
        private $idEmpresa;
        private $empresaNombre;
        private $empresaDireccion;

        private static $contadorId = 1;//Variable para ir autoincrementando el idEmpresa


        //CONSTRUCTOR
        public function __construct($empresaNombre, $empresaDireccion)
        {
            $this -> idEmpresa = self::$contadorId;
            self::$contadorId++;//Incrementar para la proxima instancia

            $this -> empresaNombre = $empresaNombre;
            $this -> empresaDireccion = $empresaDireccion;
        }

        //METODOS DE ACCESO SETTERS Y GETTER
        public function getIdEmpresa(){
            return $this -> idEmpresa;
        }
        public function getEmpresaNombre(){
            return $this -> empresaNombre;
        }   
        public function getEmpresaDireccion(){
            return $this -> empresaDireccion;
        }
        public function setEmpresaNombre($empresaNombre){
            $this -> empresaNombre = $empresaNombre;
        }   
        public function setEmpresaDireccion($empresaDireccion){
            $this -> empresaDireccion = $empresaDireccion;
        }

        public function __toString() {
            $mensaje = "\n--------------DATOS DE LA EMPRESA------------------\n";
            $mensaje .= "Id de la Empresa: " . $this -> getIdEmpresa() . "\n";
            $mensaje .= "Nombre: " . $this -> getEmpresaNombre() . "\n";
            $mensaje .= "Direccion: " . $this -> getEmpresaDireccion() . "\n";

            return $mensaje;
        }

    }





?>