<?php

include_once  "Empresa.php";

function menuEmpresa(){
    $opciones = "----------MENU EMPRESA----------";
    $opciones .= "\n1. Listar Empresas";
    $opciones .= "\n2. Buscar Empresa";
    $opciones .= "\n3. Insertar Empresa";
    $opciones .= "\n4. Modificar Empresa";
    $opciones .= "\n5. Eliminar Empresa";
    return $opciones;
}

function llamarFuncionSeleccionadaEmpresa($opcion) {
    switch ($opcion) {
        case 1:
            echo listarEmpresasNumeradas();
            break;
        case 2:
            echo "Ingrese el ID de la empresa a buscar: ";
            $idEmpresa = trim(fgets(STDIN));
            if($empresaEncontrada = buscarEmpresa($idEmpresa )!== null) {
                echo "Empresa encontrada:\n";
                echo $empresaEncontrada;
            } else {
                echo "No se encontró la empresa con ID: $idEmpresa\n";
            }
            break;
            
        case 3:
            echo "Ingrese los datos de la empresa:\n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Dirección: ";
            $direccion = trim(fgets(STDIN));
            $empresa = new Empresa($nombre, $direccion);
            return insertarEmpresa($empresa);
            break;
        case 4:
            echo "Ingrese los datos de la empresa a modificar:\n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese Direccion: ";
            $direccion = trim(fgets(STDIN));
            $empresa = new Empresa($nombre, $direccion);
            return modificarEmpresa($empresa);
            break;
        case 5:
            echo "Ingrese la empresa que quiere eliminar: \n";
            echo "Ingrese el id: \n";
            $idEmpresa = trim(fgets(STDIN));
            return eliminarEmpresa($idEmpresa);
            break;
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarEmpresasNumeradas() {

    echo "Listando empresas numeradas...\n";

    $resultado = "";
    $empresas = Empresa::Listar();
    if (empty($empresas) || count($empresas) === 0) {
        $resultado = "No hay empresas registradas.";
    } else {
        $resultado = "Listado de Empresas:\n";
        $i = 1;
        foreach ($empresas as $empresa) {
            $resultado .= "#$i " . $empresa->toString() . "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}
function buscarEmpresa($idEmpresa){ 
    return Empresa::Buscar($idEmpresa); 
}

function insertarEmpresa($empresa) {
    if($empresa -> Insertar()) {
        echo "La empresa se inserto con exito!\n";
    } else {
        echo "No se puedo insertar la empresa";
    }
    
}

function modificarEmpresa($empresa) {
    if($empresa->Modificar()){
        echo "La Empresa se modifico con exito!";
    } else {
        echo "No se pudo modificar la empresa";
    }
    
    
}

function eliminarEmpresa($empresa) {
    if ($empresa -> eliminar()) {
        echo "Se elimino la empresa!";
    } else {
        echo "NO se pudo eliminar la empresa";
    }
}




