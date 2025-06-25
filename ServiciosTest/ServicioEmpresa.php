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
                echo "ID: " . $empresaEncontrada->getIdEmpresa() . "\n";
                echo "Nombre: " . $empresaEncontrada->getEmpresaNombre() . "\n";
                echo "Dirección: " . $empresaEncontrada->getEmpresaDireccion() . "\n";
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
            //para modificar una empresa deberia solicitar el id de empresa,
            //buscar la empresa, mostrarla al usuario y preguntarle los nuevos datos
            echo "Ingrese los datos de la empresa a modificar:\n";
            echo "Id: ";
            $id = trim(fgets(STDIN));
            $empresaParaEditar = buscarEmpresa($id);
            //si la empresa no existe, se devuelve un mensaje de error
            //si existe, se muestra la empresa y se le pide al usuario los nuevos datos
            if ($empresaParaEditar == null) {
                echo "No se encontró la empresa con ID: $id\n";
            } else {
                echo "Empresa encontrada:\n";
                echo "ID: " . $empresaParaEditar->getIdEmpresa() . "\n";
                echo "Nombre: " . $empresaParaEditar->getEmpresaNombre() . "\n";
                echo "Dirección: " . $empresaParaEditar->getEmpresaDireccion() . "\n";
                echo "Ingrese nuevo Nombre: ";// Solicitar al usuario el nuevo nombre
                //y la nueva direccion
                $nombreNuevo = trim(fgets(STDIN));
                echo "Ingrese nueva Direccion: ";
                $direccionNueva = trim(fgets(STDIN));
                // Crear un nuevo objeto Empresa con los datos actualizados
                //y asignarle el id de la empresa a editar
                $empresaEditada = new Empresa($nombreNuevo, $direccionNueva);
                $empresaEditada->setIdEmpresa($id); // Asignar el ID de la empresa a editar
                echo "Datos de la empresa a modificar:\n";
                echo modificarEmpresa($empresaEditada);
                // Llamar a la función modificarEmpresa para actualizar los datos
                //y mostrar el resultado de la operación
                echo buscarEmpresa($id);
            }
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

    $resultado= "Listando empresas numeradas...\n";

    $empresas = Empresa::Listar();
    if (empty($empresas) || count($empresas) === 0) {
        $resultado .= "No hay empresas registradas.";
    } else {
        $resultado .= "Listado de Empresas:\n";
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
    //para modificar una empresa deberia solicitar el id de empresa, 
    //buscar la empresa, mostrarla al usuario y preguntarle los nuevos datos, lo unico que se puede cambiar el el nombre o la direccion

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
            $resultado = "Se eliminó la empresa!\n";
        } else {
            $resultado = "NO se pudo eliminar la empresa\n";
        }
    } else {
        $resultado = "No se encontró la empresa con ID: $idEmpresa\n";
    }
    return $resultado;
}
