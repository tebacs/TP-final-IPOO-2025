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
        $empresaEncontrada=null;
        $consulta = "SELECT * FROM Empresa WHERE idEmpresa= '" . $id . "' AND borrado IS NULL";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($fila = $base->Registro()) {
                    $empresaEncontrada = null;
                    if(is_array($fila)){                                           
                    $empresaEncontrada = new Empresa(
                        $fila['empresaNombre'],
                        $fila['empresaDireccion']                    
                    );
                    $empresaEncontrada->setIdEmpresa($id);
                } 
                } else {
                    throw new Exception("No se encontró la empresa con ID: " . $id);
                }
            } else {
                throw new Exception($base->getError());
            }
        } else {
            throw new Exception($base->getError());
        }
        
        return $empresaEncontrada;
    }
    

    /**
     * Recupera las empresas según su id
     */
    public static function Listar($condicion = '')
    {
        $aEmpresa = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM Empresa";
        if ($condicion != '') {
            $consulta .= " WHERE "  . $condicion . " AND borrado IS NULL";
        } else {
            $consulta .= " WHERE borrado IS NULL";
        }

        $consulta .= " order by idEmpresa";

        if ($base->Iniciar()) {
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

        if ($base->Iniciar()) {
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
        $consulta = "UPDATE empresa SET empresaNombre= '" . $this->getEmpresaNombre() . "', empresaDireccion= '" . $this->getEmpresaDireccion() . "' WHERE idEmpresa= '" . $this->getIdEmpresa() . "'";

        if ($base->Iniciar()) {
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

        if ($base->Iniciar()) {
            $consulta = "UPDATE Empresa SET borrado= CURRENT_DATE WHERE idEmpresa= '" . $this->getIdEmpresa() . "'";
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