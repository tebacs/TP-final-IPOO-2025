<?php

include_once  "Empresa.php";
include_once "BaseDatos.php";

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
            
        case 3:
            echo "Ingrese los datos de la empresa:\n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Dirección: ";
            $direccion = trim(fgets(STDIN));
            $empresa = new Empresa($nombre, $direccion);
            return insertarEmpresa($empresa);
        case 4:
            return modificarEmpresa();
        case 5:
            return eliminarEmpresa();
        default:
            return "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
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
    echo "Insertando empresa...\n";
    
}

function modificarEmpresa($empresa) {
    echo "Modificando empresa...\n";
    
    
}

function eliminarEmpresa($empresa) {
    echo "Eliminando empresa...\n";
}




