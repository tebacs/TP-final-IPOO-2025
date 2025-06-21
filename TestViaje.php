<?php

include_once "ServiciosTest/ServicioEmpresa.php";
include_once "ServiciosTest/ServicioViaje.php";
include_once "ServiciosTest/ServicioPasajero.php";
include_once "ServiciosTest/ServicioResponsable.php";
include_once "ServiciosTest/ServicioPersona.php";



function menu1()
{
    $opciones = "----------MENU----------";
    $opciones .= "\n1. Empresa";
    $opciones .= "\n2. Viaje";
    $opciones .= "\n3. Pasajeros";
    $opciones .= "\n4. Responsables";
    $opciones .= "\n5. Persona";
    return $opciones;
}

echo menu1();
echo "\nIngresar opción deseada: ";
$opcion = trim(fgets(STDIN));

switch ($opcion) {

    case 1:
        echo menuEmpresa();
        echo "\nIngresar opción deseada: ";
        $opcion = trim(fgets(STDIN));
        llamarFuncionSeleccionadaEmpresa($opcion);
        break;

    case 2:
        echo menuViaje();
        echo "\nIngresar opción deseada: ";
        $opcion = trim(fgets(STDIN));
        llamarFuncionSeleccionadaViaje($opcion);
        break;

    case 3:
        echo menuPasajero();
        echo "\nIngresar opción deseada: ";
        $opcion = trim(fgets(STDIN));
        llamarFuncionSeleccionadaPasajero($opcion);
        break;

    case 4:
        echo menuResponsable();
        echo "\nIngresar opción deseada: ";
        $opcion = trim(fgets(STDIN));
        llamarFuncionSeleccionadaResponsable($opcion);
        break;

    case 5:
        echo menuPersona();
        echo "\nIngresar opción deseada: ";
        $opcion = trim(fgets(STDIN));
        llamarFuncionSeleccionadaPersona($opcion);
        break;
    case 6:
        echo "Volver a l menú inicial   \n ";
        echo menu1();
        break;
    default:
        echo "Opción no válida. Por favor, ingrese una opción del 1 al 6.\n";
        break;
}