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
            echo listarPersonas();
            break;
        case 2:
            echo "Ingrese el ID de la persona a buscar: ";
            $idPersona = trim(fgets(STDIN));
            $personaEncontrada = buscarPersona($idPersona );
            if($personaEncontrada!== null) {
                echo "persona encontrada:\n";
                echo $personaEncontrada;
            } else {
                echo "No se encontró la persona con ID: $idPersona\n";
            }
            break;
        case 3:
            echo "Ingrese los datos de la persona:\n";            
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));
            $personaData = new Persona($nombre, $apellido);            
            echo insertarPersona($personaData);
            break;
        case 4:
            echo "Ingrese el ID de la persona a modificar \n";
            $idPersona = trim(fgets(STDIN));
            $persona = Persona::Buscar($idPersona);
            if($persona !== null){
                echo "Nuevo nombre: \n";
                $nombre = trim(fgets(STDIN));
                echo "Nuevo apellido: \n";
                $apellido = trim(fgets(STDIN));

                $persona->setNombre($nombre);
                $persona->setApellido($apellido);
                echo modificarPersona($persona);
            }
            break;
        case 5:
            echo "Ingrese la persona que desea eliminar\n";
            echo "IdPersona: \n";
            $idPersona = trim(fgets(STDIN));

            $persona = Persona::Buscar($idPersona);
            if($persona!==null){
                echo eliminarPersona($persona);
            }else{
                echo "No existe niguna persona con ese ID";
            }
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarPersonas() {
    echo "Listando personas...\n";

    $resultado = "";
    $personas = Persona::Listar();
    if (empty($personas) || count($personas) === 0) {
        $resultado = "No hay personas registradas.";
    } else {
        $resultado = "Listado de personas:\n";
        $i = 1;
        foreach ($personas as $persona) {
            $resultado .= "#$i " . $persona. "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}

function buscarPersona($idPersona) {
    return Persona::Buscar($idPersona);
}

function insertarPersona($persona) { 
    if($persona->Insertar()){
        echo "La persona se inserto con exito!\n";
    }else{
        echo "No se pudo insertar la persona.\n";
    }
}

function modificarPersona($persona) {
    if($persona->Modificar()){
        echo "La persona se modifico con exito!\n";
    }else{
        echo "No se pudo modificar la persona.\n";
    }
}

function eliminarPersona($persona) {
    if($persona->Eliminar()){
        echo "se elimino la persona con exito.\n";
    }else{
        echo "no se pudo eliminar la persona.\n";
    }
    // Aquí se implementaría la lógica para eliminar una persona
}

