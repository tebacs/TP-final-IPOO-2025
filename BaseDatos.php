<?php
class BaseDatos
{
    //ATRIBUTOS - VARIABLES INTANCIA 
    private $HOSTNAME;
    private $BASEDATOS;
    private $USUARIO;
    private $CLAVE;
    private $CONEXION;
    private $QUERY;
    private $RESULT;
    private $ERROR;

    /**
     * Constructor de la clase que inicia ls variables instancias de la clase
     * vinculadas a la coneccion con el Servidor de BD
     */
    public function __construct()
    {
        $this->HOSTNAME = "Localhost";
        $this->BASEDATOS = "bdviajes";
        $this->USUARIO = "viggiano";
        $this->CLAVE = "FAI-5516";
        $this->RESULT = 0;
        $this->QUERY = "";
        $this->ERROR = "";
    }

    /*** Funcion que retorna una cadena
     * con una peque�a descripcion del error si lo hubiera
     *
     * @return string
     */

    //METODOS DE ACCESO GETTERS Y SETTERS
    public function getError(){
        return "\n" . $this->ERROR;
    }
     public function setError($error){
        $this -> ERROR = $error;
    }

    public function getHostname(){
        return "\n" . $this -> HOSTNAME;
    }
    public function setHostname($hostname){
        $this -> HOSTNAME = $hostname;
    }

    public function getUsuario(){
        return "\n" . $this -> USUARIO;
    }
    public function setUsuario($usuario){
        $this -> USUARIO = $usuario;
    }

    public function getClave(){
        return "\n" . $this -> CLAVE;
    }
    public function setClave($clave){
        $this -> CLAVE = $clave;
    }       

    public function getBasedatos(){
        return "\n" . $this -> BASEDATOS;
    }
    public function setBasedatos($basedatos){
        $this -> BASEDATOS = $basedatos;
    }
    
    public function getConexion(){
        return $this -> CONEXION;
    }
    public function setConexion($conexion){
        $this -> CONEXION = $conexion;
    }
    public function getQuery(){
        return $this -> QUERY;
    }
    public function setQuery($query){
        $this -> QUERY = $query;
    }
    public function getResult(){
        return $this -> RESULT;
    }
    public function setResult($result){
        $this -> RESULT = $result;
    }

    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario
     *
     * @return boolean
     */
    public  function iniciar(){
        $exito  = false;

        $conexion = mysqli_connect(
            $this->getHostname(),
            $this->getUsuario(),
            $this->getClave(),
            $this->getBasedatos()
        );

        if ($conexion){
            $this->setConexion($conexion);
            $this->setQuery('');
            $this->setError('');

            $exito = true;
        }else{
            $this->setError(mysqli_connect_errno() . ": " . mysqli_connect_error());
        }

        return $exito;
    }

    /**
     * Ejecuta una consulta en la Base de Datos.
     * Recibe la consulta en una cadena enviada por parametro.
     *
     * @param string $consulta
     * @return boolean
     */
    public function Ejecutar($consulta)
    {
        $resp  = false;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if ($this->RESULT = mysqli_query($this->CONEXION, $consulta)) {
            $resp = true;
        } else {
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
        return $resp;
    }

    /**
     * Devuelve un registro retornado por la ejecucion de una consulta
     * el puntero se despleza al siguiente registro de la consulta
     *
     * @return boolean
     */
    public function Registro()
    {
        $resp = null;
        if ($this->RESULT) {
            unset($this->ERROR);
            if ($temp = mysqli_fetch_assoc($this->RESULT)) {
                $resp = $temp;
            } else {
                mysqli_free_result($this->RESULT);
            }
        } else {
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
        return $resp;
    }

    /**
     * Devuelve el id de un campo autoincrement utilizado como clave de una tabla
     * Retorna el id numerico del registro insertado, devuelve null en caso que la ejecucion de la consulta falle
     *
     * @param string $consulta
     * @return int id de la tupla insertada
     */
    public function devuelveIDInsercion($consulta)
    {
        
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if ($this->RESULT = mysqli_query($this->CONEXION, $consulta)) {
            $id = mysqli_insert_id($this->CONEXION);
            $resp =  $id;
        } else {
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
        return $resp;
    }
}
