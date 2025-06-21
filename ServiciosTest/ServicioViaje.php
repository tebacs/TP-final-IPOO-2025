<?php
include_once  "Viaje.php";

function menuViaje(){
    $opciones = "----------MENU VIAJE----------";
    $opciones .= "\n1. Listar Viajes";
    $opciones .= "\n2. Buscar Viaje";
    $opciones .= "\n3. Insertar Viaje";
    $opciones .= "\n4. Modificar Viaje";
    $opciones .= "\n5. Eliminar Viaje";
    return $opciones;
}

function llamarFuncionSeleccionadaViaje($opcion) {
    switch ($opcion) {
        case 1:
            return listarViajes();
            break;
        case 2:
            return buscarViaje();
            break;
        case 3:
            return insertarViaje();
            break;
        case 4:
            return modificarViaje();
            break;
        case 5:
            return eliminarViaje();
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
    }
}

function listarViajes() {

    echo "Listando viajes numerados...\n";

    // $resultado = "";
    // $viajes = Viaje::listarViajes();
    // if (empty($viajes) || count($viajes) === 0) {
    //     $resultado = "No hay viajes registrados.";
    // } else {
    //     $resultado = "Listado de Viajes:\n";
    //     $i = 1;
    //     foreach ($viajes as $viaje) {
    //         $resultado .= "#$i " . $viaje->toString() . "\n";
    //         $resultado .= "--------------------------------\n";
    //         $i++;
    //     }
    // }
    // return $resultado;
}

function buscarViaje() {
    echo "Buscando viaje...\n";   
}

function insertarViaje($viaje) {
    echo "Insertando viaje...\n";
    
}

function modificarViaje($viaje) {
    echo "Modificando viaje...\n";
    
}

function eliminarViaje($viaje) {
    echo "Eliminando viaje...\n";
    
}

