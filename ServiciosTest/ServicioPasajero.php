<?php


include_once "Pasajero.php";
function menuPasajero() {
    $opciones = "----------MENU PASAJERO----------";
    $opciones .= "\n1. Listar Pasajeros";
    $opciones .= "\n2. Buscar Pasajero";
    $opciones .= "\n3. Insertar Pasajero";
    $opciones .= "\n4. Modificar Pasajero";
    $opciones .= "\n5. Eliminar Pasajero";
    return $opciones;
}

function llamarFuncionSeleccionadaPasajero($opcion) {
    switch ($opcion) {
        case 1:
            return listarPasajeros();
        case 2:
            echo "Ingrese el DNI del pasajero a buscar: ";
            $dniPasajero = trim(fgets(STDIN));
            return buscarPasajero($dniPasajero);
        case 3:
            echo "Ingrese los datos del pasajero:\n";            
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));
            echo "Documento: ";
            $dni = trim(fgets(STDIN));
            echo "Teléfono: ";
            $telefono = trim(fgets(STDIN));
            $pasajeroData = new Pasajero($nombre, $apellido, $dni, $telefono);            
            return insertarPasajero($pasajeroData);
        case 4:
            return modificarPasajero();

        case 5:
            return eliminarPasajero();
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
    }
}

function listarPasajeros() {
    echo "Listando pasajeros...\n";


}

function buscarPasajero($dniPasajero) {
    echo "Buscando pasajero...\n";   
}

function insertarPasajero($pasajero) {
    echo "Insertando pasajero...\n";   
    $pasajero->insertar();
    echo "Pasajero insertado correctamente.\n";
    

}

function modificarPasajero($pasajero) {
    echo "Modificando pasajero...\n";

}
function eliminarPasajero($pasajero) {
    echo "Eliminando pasajero...\n";   
 
}