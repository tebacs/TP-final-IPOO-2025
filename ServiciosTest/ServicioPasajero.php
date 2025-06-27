<?php
include_once "BaseDatos.php";
include_once "Persona.php";
include_once "Pasajero.php";
function menuPasajero()
{
    $opciones = "----------MENU PASAJERO----------";
    $opciones .= "\n1. Listar Pasajeros";
    $opciones .= "\n2. Buscar Pasajero";
    $opciones .= "\n3. Insertar Pasajero";
    $opciones .= "\n4. Modificar Pasajero";
    $opciones .= "\n5. Eliminar Pasajero";
    return $opciones;
}

function llamarFuncionSeleccionadaPasajero($opcion)
{
    switch ($opcion) {
        case 1:
            echo listarPasajeros();
            break;
        case 2:
            echo "Ingrese el ID del pasajero: ";
            $idPersona = trim(fgets(STDIN));
            $pasajeroEncontrado = buscarPasajero($idPersona);
            if ($pasajeroEncontrado !== null) {
                echo "pasajero encontrado:\n";
                echo $pasajeroEncontrado;
            } else {
                echo "No se encontró el pasajero con ID: $idPersona\n";
            }
            break;
        case 3:
            echo "Ingrese los datos del pasajero:\n";
            echo "nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "apellido: ";
            $apellido = trim(fgets(STDIN));
                echo "Numero documento: ";
                $nroDocumento = trim(fgets(STDIN));
                echo "Numero telefono: ";
                $nroTelefono = trim(fgets(STDIN));
                $pasajero = new Pasajero($nombre, $apellido, $nroDocumento, $nroTelefono);
                echo insertarPasajero($pasajero);
            break;
        case 4:
            echo "Ingrese el ID del pasajero a modificar:\n";
            $idPasajero = trim(fgets(STDIN));
            $pasajero = Pasajero::Buscar($idPasajero);
            if ($pasajero !== null) {
                echo "Nuevo numero de Documento: ";
                $nuevoNroDoc = trim(fgets(STDIN));
                echo "Nuevo numero de telefono: ";
                $nuevoNroTel = trim(fgets(STDIN));

                $pasajero->setDocumentoPasajero($nuevoNroDoc);
                $pasajero->setTelefonoPasajero($nuevoNroTel);

                echo modificarPasajero($pasajero);
            } else {
                echo "no existe el Pasajero";
            }

            break;

        case 5:
            echo "Ingrese el pasajero que quiere eliminar: \n";
            echo "Ingrese el id: \n";
            $idPasajero = trim(fgets(STDIN));
            $pasajero = Pasajero::Buscar($idPasajero);
            if ($pasajero !== null) {
                echo eliminarPasajero($pasajero);
            } else {
                echo "No existe ningun pasajero con este ID";
            }
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
    }
}

function listarPasajeros()
{
    echo "Listando pasajeros...\n";

    $resultado = "";
    $pasajeros = Pasajero::Listar();
    if (empty($pasajeros) || count($pasajeros) === 0) {
        $resultado = "No hay pasajeros registrados.";
    } else {
        $resultado = "Listado de pasajeros:\n";
        $i = 1;
        foreach ($pasajeros as $pasajero) {
            $resultado .= "#$i " . $pasajero . "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;


}

function buscarPasajero($dniPasajero)
{
    return Pasajero::Buscar($dniPasajero);
}

function insertarPasajero($pasajero)
{
    echo "Insertando pasajero...\n";
    $pasajero->insertar();
    echo "Pasajero insertado correctamente.\n";


}

function modificarPasajero(Pasajero $pasajero)
{
    echo "Modificando pasajero...\n";
    if ($pasajero->Modificar()) {
        echo "El responsable se modifico con exito!";
    } else {
        echo "No se pudo modificar el responsable";
    }

}
function eliminarPasajero(Pasajero $pasajero)
{
      if ($pasajero -> eliminar()) {
        echo "Se elimino el Pasajero!\n";
    } else {
        echo "NO se pudo eliminar el pasajero.\n";
    }

}