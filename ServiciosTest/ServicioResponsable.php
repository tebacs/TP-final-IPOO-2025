<?php

include_once "Responsable.php";

function menuResponsable() {
    $opciones = "----------MENU RESPONSABLE----------";
    $opciones .= "\n1. Listar Responsables";
    $opciones .= "\n2. Buscar Responsable";
    $opciones .= "\n3. Insertar Responsable";
    $opciones .= "\n4. Modificar Responsable";
    $opciones .= "\n5. Eliminar Responsable";
    return $opciones;
}

function llamarFuncionSeleccionadaResponsable($opcion) {
    switch ($opcion) {
        case 1:
            return listarResponsables();
            break;
        case 2:
            return buscarResponsable();
            break;
        case 3:
            return insertarResponsable();
            break;
        case 4:
            return modificarResponsable();
            break;
        case 5:
            return eliminarResponsable();
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarResponsables() {
    echo "Listando responsables...\n";
    // Aquí se implementaría la lógica para listar los responsables
}

function buscarResponsable() {
    echo "Buscando responsable...\n";
    // Aquí se implementaría la lógica para buscar un responsable
}

function insertarResponsable() {
    echo "Insertando responsable...\n";
    // Aquí se implementaría la lógica para insertar un nuevo responsable
}

function modificarResponsable() {
    echo "Modificando responsable...\n";
    // Aquí se implementaría la lógica para modificar un responsable existente
}

function eliminarResponsable() {
    echo "Eliminando responsable...\n";
    // Aquí se implementaría la lógica para eliminar un responsable
}

