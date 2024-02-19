<?php
require_once '../Model/Citas.php';

class CitasController {
    
    public static function buscarCitas($matricula){
        try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM citas WHERE matricula='$matricula'");
            if ($result->num_rows){
                $reg = $result->fetch_object();
                $p = new Citas($reg->matricula, $reg->id_itv, $reg->fecha, $reg->hora, $reg->ficha);
            }
            else{
                $p=0;
            }
        } catch (Exception $ex) {
            $p=false;
        }
        return $p;
    }
    
    public static function recuperaTodosBuscados($id){
         try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM citas where id_itv=$id");
            if ($result->num_rows){
                while ($reg=$result->fetch_object()){
                    $p = new Citas($reg->matricula, $reg->id_itv, $reg->fecha, $reg->hora, $reg->ficha);
                    $products[]=$p;
                }
            }
            else{
                $products=0;
            }
        } catch (Exception $ex) {
            $p=false;
        }   
        return $products;
    }
    
    public static function borrarCita($matricula){
        try {
            $conex = new Conexion();
            $conex->query("DELETE FROM citas WHERE matricula='$matricula'");
            $filas=$conex->affected_rows;
            //ver el numero de filas afectadas por una instruccion que no devuelve resultados(de la ultima instrucion ejecutada)
            $conex->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $filas=false;
        }
        return $filas;
    }
    
    public static function insertar(Citas $p){
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO citas VALUES('$p->matricula', $p->id_itv, '$p->fecha', '$p->hora', '$p->ficha')");
            $filas=$conex->affected_rows;
            //ver el numero de filas afectadas por una instruccion que no devuelve resultados(de la ultima instrucion ejecutada)
            $conex->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $filas=false;
        }
        return $filas;
    }
    
}
