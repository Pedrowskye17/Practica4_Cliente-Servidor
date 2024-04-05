<?php
   class Conexion extends PDO{
    private $tipobase='mysql';
    private $host='localhost';
    private $nombreBD='turismo_sitios';
    private $usuario='root';
    private $pass='';
    public function __construct() { 
        parent::__construct("{$this->tipobase}:dbname={$this->nombreBD};host={$this->host};charset=utf8",$this->usuario,$this->pass);
    }
}
?>