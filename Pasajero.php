<?php
include_once 'BaseDatos.php';
//Clase Pasajero que hereda de Persona
class Pasajero extends Persona {

    //ATRIBUTOS Y VARIABLES INSTANCIA
    private $documentoPasajero;
    private $telefonoPasajero;

    //METODO CONSTRUCTOR
    public function __construct($idPersona, $nombre, $apellido, $documentoPasajero, $telefonoPasajero) {
        parent::__construct($idPersona, $nombre, $apellido);
        $this->documentoPasajero = $documentoPasajero;
        $this->telefonoPasajero = $telefonoPasajero;
    }   

    //METODOS DE ACCESO GETTERS Y SETTERS
    public function getDocumentoPasajero() {
        return $this->documentoPasajero;
    }
    public function setDocumentoPasajero($documentoPasajero) {
        $this->documentoPasajero = $documentoPasajero;
    }
    public function getTelefonoPasajero() {
        return $this->telefonoPasajero;
    }
    public function setTelefonoPasajero($telefonoPasajero) {
        $this->telefonoPasajero = $telefonoPasajero;
    }
    public function __toString() {
        $mensaje = parent::__toString();
        $mensaje .= "Documento Pasajero: " . $this->getDocumentoPasajero() . "\n";
        $mensaje .= "Telefono Pasajero: " . $this->getTelefonoPasajero() . "\n";

        return $mensaje;
    }
}





?>