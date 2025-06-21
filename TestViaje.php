<?php

include_once "ServiciosTest/ServicioEmpresa.php";

function menu1()
{
    echo menuEmpresa();
}

echo menu1();
echo "\nIngresar opción deseada: ";
$opcion = trim(fgets(STDIN));

switch ($opcion) {
    case 1:
        echo "Empresa";
        //mostrar menu de empresa;
        break;

    case 2:
        echo "viaje";
        //mostrar menu de viajes;
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