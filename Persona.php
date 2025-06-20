<?php
    //Clase Abstracta o Padre de class Cliente
    class Persona {
        //ATRIBUTOS
        private $DNI;
        private $nombre;
        private $apellido;

        //METODO CONSTRUCTOR
        public function __construct($dni, $nombre, $apellido) {
            $this -> DNI = $dni;
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
        }

        //METODOS DE ACCESO 
        public function getDNI(){
            return $this->DNI;
        }

        public function setDNI($dni){
            $this -> DNI = $dni;
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
            $mensaje .= "DNI: " . $this -> getDNI() . "\n";

            return $mensaje;
        }
    }



?>