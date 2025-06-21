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

function listarEmpresasNumeradas() {
    $resultado = "";
    $empresas = Empresa::listarEmpresas();
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
function buscarEmpresa(){


}

function insertarEmpresa($empresa) {}

function modificarEmpresa($empresa) {}

function eliminarEmpresa($empresa) {}




