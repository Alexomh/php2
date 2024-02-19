<?php
require_once '../Model/Vehiculo.php';

class VehiculoController {
    
    public static function buscarVehiculo($matricula){
        try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM vehiculo WHERE matricula='$matricula'");
            if ($result->num_rows){
                $reg = $result->fetch_object();
                $p = new Vehiculo($reg->matricula, $reg->marca, $reg->modelo, $reg->color, $reg->plazas, $reg->fecha_ultima_revision);
            }
            else{
                $p=0;
            }
        } catch (Exception $ex) {
            $p=false;
        }
        return $p;
    }
    
    
}
