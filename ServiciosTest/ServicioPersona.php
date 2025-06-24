<?php

include_once "Persona.php";
function menuPersona() {
    $opciones = "----------MENU PERSONA----------";
    $opciones .= "\n1. Listar Personas";
    $opciones .= "\n2. Buscar Persona";
    $opciones .= "\n3. Insertar Persona";
    $opciones .= "\n4. Modificar Persona";
    $opciones .= "\n5. Eliminar Persona";
    return $opciones;
}

function llamarFuncionSeleccionadaPersona($opcion) {
    switch ($opcion) {
        case 1:
            return listarPersonas();
            break;
        case 2:
            echo "Ingrese id: ";
            $id = trim(fgets(STDIN));
            return buscarPersona($id);
            break;
        case 3:
            echo "Ingrese los datos de la persona:\n";            
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));
            $personaData = new Persona($nombre, $apellido);            
            return insertarPersona($personaData);
            break;
        case 4:
            echo "Ingrese los datos del Pasajero: \n";
            echo "Nombre: \n";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));
            $personaData = new Persona($nombre, $apellido);
            return modificarPersona($personaData);
            break;
        case 5:
            echo "Ingrese la persona que desea eliminar\n";
            echo "IdPersona: \n";
            $idPersona = trim(fgets(STDIN));
            return eliminarPersona($idPersona);
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarPersonas() {
    echo "Listando personas...\n";

}

function buscarPersona($id) {
    echo "Buscando persona...\n";   
}

function insertarPersona($persona) {
    echo "Insertando persona...\n";   
    $persona->insertar();
    echo "Persona insertada correctamente.\n";
}

function modificarPersona() {
    echo "Modificando persona...\n";   
}

function eliminarPersona() {
    echo "Eliminando persona...\n";   
    // Aquí se implementaría la lógica para eliminar una persona
}

