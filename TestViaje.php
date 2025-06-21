<?php

include_once "ServiciosTest/ServicioEmpresa.php";
include_once "ServiciosTest/ServicioViaje.php";


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
        echo "pasajeros";
        //mostrar menu de pasajeros;
        break;

    case 4:
        echo "responsables";
        //mostrar menu de responsables;
        break;

    case 5:
        echo "persona";
        //mostrar menu de persona;

        break;
    case 6:
        echo "Volver a l menú inicial   \n ";
        echo menu1();

        break;
    default:
        echo "Opción no válida. Por favor, ingrese una opción del 1 al 6.\n";
        break;
}