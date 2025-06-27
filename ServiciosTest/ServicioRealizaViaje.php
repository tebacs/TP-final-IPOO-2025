<?php
include_once "RealizaViaje.php";

function menuRealizaViaje(){
    $opciones= "----------MENU REALIZA VIAJE----------";
    $opciones.= "\n1. Listar Viajes Realizados";
    $opciones.= "\n2. Buscar Viaje Realizado";
    $opciones .= "\n3. Insertar Viaje Realizado";
    $opciones .= "\n4. Eliminar Viaje Realizado";
    return $opciones;
}

function llamarFuncionSeleccionadaRealizaViaje($opcion){
    switch($opcion){
        case 1://Listar
            echo listarRealizaViajeNumerados();
            break;
        case 2://buscar por id de pasajero y de viaje
            echo "Ingrese el ID del pasajero: ";
            $idPasajero= trim(fgets((STDIN)));
            echo "\nIngrese el ID del viaje: ";
            $idViaje= trim(fgets(STDIN));
            $realizaViajeEncontrado= buscarRealizaViaje($idPasajero, $idViaje);
            if($realizaViajeEncontrado != null){
                echo "\nViaje Realizado encontrado:\n";
                echo "ID Pasajero: " . $realizaViajeEncontrado->getIdPasajero() . "\n";
                echo "ID Viaje: " . $realizaViajeEncontrado->getIdViaje() . "\n";
                echo "Fecha: " . $realizaViajeEncontrado->getFecha();
            }else{
                echo "No se encontró el viaje realizado con Pasajero de ID: $idPasajero y Viaje con ID: $idViaje\n";
            }
            break;
        case 3://Insertar
            echo "Ingrese los datos del viaje y el pasajero que lo realiza:\n";
            echo "ID Viaje:";
            $idViaje= trim(fgets(STDIN));
            echo "\nID Pasajero:";
            $idPasajero= trim(fgets(STDIN));
            $viaje= Viaje::Buscar($idViaje);
            $pasajero= Pasajero::Buscar($idPasajero);
            if($viaje!=null){
                if($pasajero!=null){
                    $cantPasajerosMax= $viaje->getMaxPasajeros();
                    $colPasajeros= $viaje->getPasajeros();
                    //verifico que se admita un pasajero mas al viaje
                    if(count($colPasajeros)+1 <= $cantPasajerosMax){
                        //pido los datos faltantes, creo una nueva tabla y agrego el pasajero a la coleccion de pasajeros del viaje
                        echo "\nFecha:";
                        $fecha= trim(fgets(STDIN));
                        $realizaViaje= new RealizaViaje($idViaje,$idPasajero,$fecha);
                        echo insertarRealizaViaje($realizaViaje);
                        array_push($colPasajeros, $pasajero);
                        $viaje->setPasajeros($colPasajeros);
                    }else{
                        echo "El viaje no admite mas pasajeros\n";
                    }
                }else{
                    echo "No existe el pasajero con ID:$idPasajero\n";
                }
            }else{
                echo "No existe el viaje con ID:$idViaje\n";
            }
            break;
        case 4://Eliminar
            echo "Va eliminar un RealizaViaje\nIngrese los datos del viaje y del pasajero\n";
            echo "ID Viaje:";
            $idViaje= trim(fgets(STDIN));
            echo "\nID Pasajero:";
            $idPasajero= trim(fgetc(STDIN));
            $realizaViaje= RealizaViaje::Buscar($idPasajero,$idViaje);
            if( $realizaViaje != null){
                echo eliminarRealizaViaje($idPasajero,$idViaje);
            }else{
                echo "No se encontró el viaje realizado con Pasajero de ID: $idPasajero y Viaje con ID: $idViaje\n";
            }
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 4.";
    }
}

function listarRealizaViajeNumerados(){
    $resultado= "Listando los viajes realizados numerados...\n";
    $realizaViajes= RealizaViaje::Listar();

    if( empty(($realizaViajes) || count($realizaViajes) ===0)){
        $resultado.= "No hay viajes realizados";
    }else{
        $resultado.= "Listado de Viajes Relaizados:\n";
        $i=1;
        foreach($realizaViajes as $realizaViaje){
            $resultado.= "#$i " . $realizaViaje . "\n";
            $resultado.= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}

function buscarRealizaViaje($idPasajero, $idViaje){
    return RealizaViaje::Buscar($idPasajero,$idViaje);
}

function insertarRealizaViaje(RealizaViaje $realizaViaje){
    $resultado="";
    if($realizaViaje->Insertar()){
        $resultado.= "El viaje realizado se inserto con éxito!\n";
    }else{
        $resultado.= "No se pudo insertar el viaje realizado\n";
    }
    return $resultado;
}


function eliminarRealizaViaje($idPasajero,$idViaje){
    $resultado="";
    $realizaViaje= RealizaViaje::Buscar($idPasajero,$idViaje);

    if($realizaViaje != null){
        if($realizaViaje->Eliminar()){
            $resultado.= "Se eliminó el viaje realizado!\n";
        }else{
            $resultado.= "No se pudo eliminar el viaje realizado\n";
        }
    }else{
        $resultado.= "No se encontró el viaje realizado con Pasajero de ID: $idPasajero y Viaje con ID: $idViaje\n";
    }
    return $resultado;
}
?>