<?php
require_once '../Controller/Conexion.php';
class Citas {
    private $matricula;
    private $id_itv;
    private $fecha;
    private $hora;
    private $ficha;
    
    public function __construct($matricula, $id_itv, $fecha, $hora, $ficha) {
        $this->matricula = $matricula;
        $this->id_itv = $id_itv;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ficha = $ficha;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    public function __toString() {
        return "-Matricula: ".$this->matricula."<br>".
                "-Id:itv: ". $this->id_itv."<br>".
                "-Fecha: ". $this->fecha."<br>".
                "-Hora: ". $this->hora."<br>".
                "-Ficha: ". $this->ficha."<br>";
    }

}
