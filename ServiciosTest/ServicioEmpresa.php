<?php

include_once "Empresa.php";

function menuEmpresa()
{
    $opciones = "----------MENU EMPRESA----------";
    $opciones .= "\n1. Listar Empresas";
    $opciones .= "\n2. Buscar Empresa";
    $opciones .= "\n3. Insertar Empresa";
    $opciones .= "\n4. Modificar Empresa";
    $opciones .= "\n5. Eliminar Empresa";
    return $opciones;
}

function llamarFuncionSeleccionadaEmpresa($opcion)
{
    switch ($opcion) {
        case 1: //listar empresas
            echo listarEmpresasNumeradas();
            break;
        case 2: //buscar empresa por id
            echo "Ingrese el ID de la empresa a buscar: ";
            $idEmpresa = trim(fgets(STDIN));
            $empresaEncontrada = buscarEmpresa($idEmpresa);
            if ($empresaEncontrada != null) {
                echo "Empresa encontrada:\n";
                echo "ID: ".$empresaEncontrada->getIdEmpresa() . "\n";
                echo "Nombre: ".$empresaEncontrada->getEmpresaNombre() . "\n";
                echo "Dirección: ".$empresaEncontrada->getEmpresaDireccion() . "\n";
            } else {
                echo "No se encontró la empresa con ID: $idEmpresa\n";
            }
            break;

        case 3: //insertar empresa
            echo "Ingrese los datos de la empresa:\n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Dirección: ";
            $direccion = trim(fgets(STDIN));
            $empresa = new Empresa($nombre, $direccion);
            echo insertarEmpresa($empresa);
            break;
        case 4: //modificar empresa
            echo "Ingrese los datos de la empresa a modificar:\n";
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese Direccion: ";
            $direccion = trim(fgets(STDIN));
            $empresa = new Empresa($nombre, $direccion);
            echo modificarEmpresa($empresa);
            break;
        case 5:
            echo "Ingrese la empresa que quiere eliminar: \n";
            echo "Ingrese el id: \n";
            $idEmpresa = trim(fgets(STDIN));
            echo eliminarEmpresa($idEmpresa);
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción del 1 al 5.";
            break;
    }
}

function listarEmpresasNumeradas()
{

    echo "Listando empresas numeradas...\n";

    $resultado = "";
    $empresas = Empresa::Listar();
    if (empty($empresas) || count($empresas) === 0) {
        $resultado = "No hay empresas registradas.";
    } else {
        $resultado = "Listado de Empresas:\n";
        $i = 1;
        foreach ($empresas as $empresa) {
            $resultado .= "#$i " . $empresa . "\n";
            $resultado .= "--------------------------------\n";
            $i++;
        }
    }
    return $resultado;
}
function buscarEmpresa($idEmpresa)
{
    //primero se verifica que existe la empresa,
    // y si exite nos traemos el objeto completo de empresa 
    $empresa = null;
    $empresa = Empresa::Buscar($idEmpresa);

    return $empresa;


}

function insertarEmpresa(Empresa $empresa)
{
    $resultado = "";
    if ($empresa->Insertar()) {
        $resultado = "La empresa se inserto con exito!\n";
    } else {
        $resultado = "No se puedo insertar la empresa\n";
    }
    return $resultado;
}

function modificarEmpresa(Empresa $empresa)
{
    $resultado = "";
    if ($empresa->Modificar()) {
        $resultado = "La Empresa se modifico con exito!\n";
    } else {
        $resultado = "No se pudo modificar la empresa\n";
    }
    return $resultado;
}

function eliminarEmpresa($idEmpresa)
{
    //primero se verifica que existe la empresa, 
    // y si exite nos traemos el objeto completo de empresa y 
    // ahi llamamos a la fc eliminar que necesita un objeto
    $resultado = "";
    $empresa = Empresa::Buscar($idEmpresa);

    //si la empresa existe, se procede a eliminarla
    //si no existe, se devuelve un mensaje de error
    if ($empresa != null) {
        if ($empresa->Eliminar()) {
            $resultado = "Se elimino la empresa!\n";
        } else {
            $resultado = "NO se pudo eliminar la empresa\n";
        }
    } else {
        $resultado = "No se encontró la empresa con ID: $idEmpresa\n";
    }
    return $resultado;
}
