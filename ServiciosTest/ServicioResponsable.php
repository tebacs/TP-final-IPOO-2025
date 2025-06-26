<?php

include_once "Responsable.php";

function menuResponsable()
{
    $opciones = "----------MENU RESPONSABLE----------";
    $opciones .= "\n1. Listar Responsables";
    $opciones .= "\n2. Buscar Responsable";
    $opciones .= "\n3. Insertar Responsable";
    $opciones .= "\n4. Modificar Responsable";
    $opciones .= "\n5. Eliminar Responsable";
    return $opciones;
}

function llamarFuncionSeleccionadaResponsable($opcion)
{
    switch ($opcion) {
        case 1:
            echo listarResponsables();
            break;
        case 2:
            echo "Ingrese el ID del responsable a buscar: ";
            $idResponsable = trim(fgets(STDIN));
            $responsableEncontrado = buscarResponsable($idResponsable);
            if ($responsableEncontrado !== null) {
                echo "Responsable encontrado:\n";
                echo $responsableEncontrado;
            } else {
                echo "No se encontró el responsable con ID: $idResponsable\n";
            }
            break;
        case 3:
            echo "Ingrese los datos del responsable:\n";
            echo "ID Persona: ";
            $idPersona = trim(fgets(STDIN));
            $persona = Persona::Buscar($idPersona);
            if ($persona !== null) {
                echo "Numero de responsable: ";
                $nroResponsable = trim(fgets(STDIN));
                echo "Numero licencia: ";
                $nroLicencia = trim(fgets(STDIN));
                $nombre = $persona->getNombre();
                $apellido = $persona->getApellido();
                $responsable = new Responsable($nombre, $apellido, $nroResponsable, $nroLicencia);
                $responsable->setIdPersona($idPersona);
                echo insertarResponsable($responsable);
            } else {
                echo "no existe una persona con ese ID.\n";
            }

            break;
        case 4:
            echo "Ingrese el ID del responsable a modificar:\n";
            $idResponsable = trim(fgets(STDIN));
            $responsable = Responsable::Buscar($idResponsable);
            if ($responsable !== null) {
                echo "Nuevo numero de responsable: ";
                $nuevoNroResponsable = trim(fgets(STDIN));
                echo "Nuevo numero de licencia: ";
                $nuevoNroLicencia = trim(fgets(STDIN));

                $responsable->setNumeroResponsable($nuevoNroResponsable);
                $responsable->setNumeroLicencia($nuevoNroLicencia);
                echo modificarResponsable($responsable);
            } else {
                echo "no existe el Responsable";
            }

            break;
        case 5:
            echo "Ingrese el reponsable que quiere eliminar: \n";
            echo "Ingrese el id: \n";
            $idResponsable = trim(fgets(STDIN));
            $responsable = Responsable::Buscar($idResponsable);
            if ($responsable !== null) {
                echo eliminarResponsable($responsable);
            } else {
                echo "No existe ningun responsable con este ID";
            }
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarResponsables()
{
    echo "Listando responsables...\n";

    $resultado = "";
    $responsables = Responsable::Listar();
    if (empty($responsables) || count($responsables) === 0) {
        $resultado = "No hay responsables registradas.";
    } else {
        $resultado = "Listado de responsables:\n";
        $i = 1;
        foreach ($responsables as $responsable) {
            $resultado .= "#$i " . $responsable . "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}

function buscarResponsable($idResponsable)
{
    return Responsable::Buscar($idResponsable);
}

function insertarResponsable( $responsable) {
    //Primero busco si existe un responsable
    // $respuesta = null;
    // $responsableExistente = Responsable::Buscar($responsable->getIdPersona());
    // if ($responsableExistente !== null) {
    //     $respuesta = "Ya existe un responsable con el ID: " . $responsable->getIdPersona() . "\n";
    // } else {
    $respuesta=null;
    $responsable->insertar();
    if($responsable === true){
        $respuesta=  "Responsable insertado correctamente.\n";
    }else{
        $respuesta= "No se pudo insertar el responsable.\n";
    }
    
     return $respuesta;

}

function modificarResponsable($responsable) {
   if($responsable->Modificar()){
        echo "El responsable se modifico con exito!";
    } else {
        echo "No se pudo modificar el responsable";
    }
}

function eliminarResponsable($responsable)
{
    if ($responsable->eliminar()) {
        echo "Se elimino el responsable!\n";
    } else {
        echo "NO se pudo eliminar el responsable.\n";
    }
}

