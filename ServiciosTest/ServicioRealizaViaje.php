<?php
include_once "RealizaViaje.php";

function menuRealizaViaje(){
    $opciones= "----------MENU REALIZA VIAJE----------";
    $opciones.= "\n1. Listar RealizaViaje";
    $opciones.= "\n2. Buscar RealizaViaje";
    $opciones .= "\n3. Insertar RealizaViaje";
    $opciones .= "\n4. Modificar RealizaViaje";
    $opciones .= "\n5. Eliminar RealizaViaje";
    return $opciones;
}

function llamarFuncionSeleccionadaRealizaViaje($opcion){
    switch($opcion){
        case 1://Listar
            echo listarRealizaViaje
    }
}
?>