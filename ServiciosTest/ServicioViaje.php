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
            echo listarViajes();
            break;
        case 2:
            echo "Ingrese el ID del viaje a buscar: ";
            $idViaje = trim(fgets(STDIN));
            $viajeEncontrado = buscarViaje($idViaje );
            if($viajeEncontrado!== null) {
                echo "Viaje encontrado:\n";
                echo $viajeEncontrado;
            } else {
                echo "No se encontró el viaje con ID: $idViaje\n";
            }
            break;
        case 3:
            echo "Ingrese los datos del viaje:\n";

            echo "ID empresa: ";
            $idEmpresa = trim(fgets(STDIN));
            $empresa = Empresa::Buscar($idEmpresa);
            if($empresa!==null){
                echo "ID responsable viaje: ";
                $idPersona = trim(fgets(STDIN));
                $responsable = Responsable::Buscar($idPersona);
                if($responsable !== null){
                    echo "Destino: ";
                    $destino = trim(fgets(STDIN));
                    echo "Cantidad maxima de pasajeros: ";
                    $cantMaxPasajeros = trim(fgets(STDIN));
                    echo "Importe: ";
                    $importe = trim(fgets(STDIN));
                    $viaje = new Viaje($idEmpresa, $responsable, $destino, $cantMaxPasajeros, $importe);
                    echo insertarViaje($viaje);
                }else{
                    echo "No existe un responsable con ese ID.\n";
                }
            }else{
                echo "No existe una empresa con ese ID.\n";
            }
            break;
        case 4:
            echo "Ingrese el ID del viaje a modificar:\n";
            $idViaje = trim(fgets(STDIN));
            $viaje = Viaje::Buscar($idViaje);
            if($viaje !== null){
                echo "ID nueva empresa: ";
                $nuevoIdEmpresa = trim(fgets(STDIN));
                $empresa = Empresa::Buscar($nuevoIdEmpresa);
                if($empresa!==null){
                    echo "ID nuevo responsable: ";
                    $nuevoIdResponsable = trim(fgets(STDIN));
                    $responsable = Responsable::Buscar($nuevoIdResponsable);
                    if($responsable !== null){
                        echo "Nuevo Destino: ";
                        $destino = trim(fgets(STDIN));
                        echo "Nueva cantidad maxima de pasajeros: ";
                        $cantMaxPasajeros = trim(fgets(STDIN));
                        echo "Nuevo Importe: ";
                        $importe = trim(fgets(STDIN));
        
                        $viaje->setDestino($destino);
                        $viaje->setIdEmpresa($nuevoIdEmpresa);
                        $viaje->setResponsableV($responsable);
                        $viaje->setMaxPasajeros($cantMaxPasajeros);
                        $viaje->setImporte($importe);

                        echo modificarViaje($viaje);
                    }else{
                        echo "Noe existe ningun responsable con ese ID.\n";
                    }
                }else{
                    echo "No existe una empresa con ese ID.\n";
                }
            }else{
                echo "no existe el viaje";
            }
            
            break;
        case 5:
            echo "Ingrese el viaje que quiere eliminar: \n";
            echo "Ingrese el id: \n";
            $idViaje= trim(fgets(STDIN));
            $viaje = Viaje::Buscar($idViaje);
            if ($viaje !== null){
                echo eliminarEmpresa($viaje);
            }else{
                echo "No existe ningun viaje con este ID";
            }
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
    }
}

function listarViajes() {

    echo "Listando viajes numerados...\n";

    $resultado = "";
    $viajes = Viaje::listar();
    if (empty($viajes) || count($viajes) === 0) {
        $resultado = "No hay viajes registrados.";
    } else {
        $resultado = "Listado de Viajes:\n";
        $i = 1;
        foreach ($viajes as $viaje) {
            $resultado .= "#$i " . $viaje . "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}

function buscarViaje($idViaje) {
    return Viaje::Buscar($idViaje);
}

function insertarViaje($viaje) {
    if($viaje -> Insertar()) {
        echo "El viaje se inserto con exito!\n";
    } else {
        echo "No se puedo insertar el viaje";
    }
}

function modificarViaje($viaje) {
    if($viaje->Modificar()){
        echo "El viaje se modifico con exito!";
    } else {
        echo "No se pudo modificar el viaje";
    }
}

function eliminarViaje($viaje) {
    if ($viaje -> eliminar()) {
        echo "Se elimino el viaje!\n";
    } else {
        echo "NO se pudo eliminar el viaje.\n";
    }
}

