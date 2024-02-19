<?php
require_once '../Controller/Conexion.php';
class Itvs {
    private $id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $telefono;
    
    
    public function __construct($id, $provincia, $localidad, $direccion, $telefono) {
        $this->id = $id;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    
     public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    public function __toString() {
        return "-Id: ".$this->id."<br>".
                "-Provincia: ". $this->provincia."<br>".
                "-Localidad: ". $this->localidad."<br>".
                "-Dirección: ". $this->direccion."<br>".
                "-Telefono: ". $this->telefono."<br>";
    }

    
}
