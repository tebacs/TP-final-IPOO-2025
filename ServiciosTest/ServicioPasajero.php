<?php
include_once "BaseDatos.php";
include_once "Persona.php";
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
            echo listarPasajeros();
            break;
        case 2:
            echo "Ingrese el ID del pasajero: ";
            $idPersona = trim(fgets(STDIN));
            $pasajeroEncontrado = buscarPasajero($idPersona);
            if($pasajeroEncontrado!== null) {
                echo "pasajero encontrado:\n";
                echo $pasajeroEncontrado;
            } else {
                echo "No se encontró el pasajero con ID: $idPersona\n";
            }
            break;
        case 3:
            echo "Ingrese los datos del pasajero:\n";
            echo "ID persona: ";
            $idPersona = trim(fgets(STDIN));
            $persona = Persona::Buscar($idPersona);
            if($persona!==null){
                echo "Numero documento: ";
                $nroDocumento = trim(fgets(STDIN));
                echo "Numero telefono: ";
                $nroTelefono = trim(fgets(STDIN));
                $nombre = $persona->getNombre();
                $apellido = $persona->getApellido();

                $pasajero = new Pasajero($nombre, $apellido, $nroDocumento, $nroTelefono);
                $pasajero->setIdPersona($idPersona);
                echo insertarPasajero($pasajero);
                }else{
                echo "No existe una persona con ese ID.\n";
            }
            break;
        case 4:
            return modificarPasajero();
            break;

        case 5:
            return eliminarPasajero();
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
    }
}

function listarPasajeros() {
    echo "Listando pasajeros...\n";

    $resultado = "";
    $pasajeros = Pasajero::Listar();
    if (empty($pasajeros) || count($pasajeros) === 0) {
        $resultado = "No hay pasajeros registrados.";
    } else {
        $resultado = "Listado de pasajeros:\n";
        $i = 1;
        foreach ($pasajeros as $pasajero) {
            $resultado .= "#$i " . $pasajero. "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;


}

function buscarPasajero($dniPasajero) {
    return Pasajero::Buscar($dniPasajero) ;
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