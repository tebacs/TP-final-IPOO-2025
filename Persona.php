<?php
    //Clase Abstracta o Padre de class Cliente
    class Persona {
        //ATRIBUTOS
        private $idPersona;
        private $nombre;
        private $apellido;

        //METODO CONSTRUCTOR
        public function __construct($idPersona, $nombre, $apellido) {
            $this -> idPersona = $idPersona;
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
        }

        //METODOS DE ACCESO 
        public function getidPersona(){
            return $this->idPersona;
        }

        public function setidPersona($idPersona){
            $this -> idPersona = $idPersona;
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
            $mensaje .= "idPersona: " . $this -> getidPersona() . "\n";

            return $mensaje;
        }
    }



?>