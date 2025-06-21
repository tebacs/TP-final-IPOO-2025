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
            return listarEmpresasNumeradas();
        case 2:
            return buscarEmpresa();
        case 3:
            return insertarEmpresa();
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

    // $resultado = "";
    // $empresas = Empresa::listarEmpresas();
    // if (empty($empresas) || count($empresas) === 0) {
    //     $resultado = "No hay empresas registradas.";
    // } else {
    //     $resultado = "Listado de Empresas:\n";
    //     $i = 1;
    //     foreach ($empresas as $empresa) {
    //         $resultado .= "#$i " . $empresa->toString() . "\n";
    //         $resultado .= "--------------------------------\n";
    //         $i++;
    //     }
    // }
    // return $resultado;
}
function buscarEmpresa(){
    echo "Buscando empresa...\n";   

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




