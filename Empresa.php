<?php
include_once 'BaseDatos.php';

class Empresa
{
    //Variables insatancia - atributos
    private $idEmpresa = 0;
    private $empresaNombre;
    private $empresaDireccion;

    //CONSTRUCTOR
    public function __construct($empresaNombre, $empresaDireccion)
    {
        $this->empresaNombre = $empresaNombre;
        $this->empresaDireccion = $empresaDireccion;
    }

    //METODOS DE ACCESO SETTERS Y GETTER
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($nuevo)
    {
        $this->idEmpresa = $nuevo;
    }

    public function getEmpresaNombre()
    {
        return $this->empresaNombre;
    }
    public function getEmpresaDireccion()
    {
        return $this->empresaDireccion;
    }
    public function setEmpresaNombre($empresaNombre)
    {
        $this->empresaNombre = $empresaNombre;
    }
    public function setEmpresaDireccion($empresaDireccion)
    {
        $this->empresaDireccion = $empresaDireccion;
    }

    public function __toString()
    {
        $mensaje = "\n--------------DATOS DE LA EMPRESA------------------\n";
        $mensaje .= "Id de la Empresa: " . $this->getIdEmpresa() . "\n";
        $mensaje .= "Nombre: " . $this->getEmpresaNombre() . "\n";
        $mensaje .= "Direccion: " . $this->getEmpresaDireccion() . "\n";

        return $mensaje;
    }

    public static function Buscar($id)
    {
        $base = new BaseDatos();
        $resp = false;
        $consulta = "SELECT * FROM Empresa WHERE idEmpresa= '" . $id . "'";

        if ($base->iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($fila = $base->Registro()) {
                    $empresaEncontrada = new Empresa(
                        $fila['empresaNombre'],
                        $fila['empresaDireccion']
                    );
                    $empresaEncontrada->setIdEmpresa($id);
                    //$resp=true;
                }
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        //return $resp;
        return $empresaEncontrada;
    }


    /**
     * Recupera las empresas según su id
     * @param mixed $condicion
     * @return void
     */
    public static function Listar($condicion = '')
    {
        $aEmpresa = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM Empresa";
        if ($condicion != '') {
            $consulta .= " WHERE " . $condicion;
        }

        $consulta .= " order by idEmpresa";

        if ($base->iniciar()) {
            if ($base->Ejecutar($consulta)) {
                while ($fila = $base->Registro()) {
                    $objEmpresa = new Empresa(
                        $fila['empresaNombre'],
                        $fila['empresaDireccion']
                    );
                    $objEmpresa->setIdEmpresa($fila['idEmpresa']);
                    $aEmpresa[] = $objEmpresa;
                }
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        return $aEmpresa;
    }

    public function Insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consulta = "INSERT INTO Empresa( empresaNombre, empresaDireccion) VALUES ('" . $this->getEmpresaNombre() . "', '" . $this->getEmpresaDireccion() . "')";

        if ($base->iniciar()) {
            if ($id = $base->devuelveIDInsercion($consulta)) {
                $this->setIdEmpresa($id);
                $resp = true;
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        return $resp;
    }

    public function Modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consulta = "UPDATE Empresa SET empresaNombre= '" . $this->getEmpresaNombre() . "', empresaDireccion= '" . $this->getEmpresaDireccion() . "' WHERE idEmpresa= '" . $this->getIdEmpresa() . "'";

        if ($base->iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        return $resp;
    }

    public function Eliminar()
    {
        $base = new BaseDatos();
        $resp = false;

        if ($base->iniciar()) {
            $consulta = "DELETE FROM Empresa WHERE idEmpresa= '" . $this->getIdEmpresa() . "'";
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        return $resp;
    }

}





?>