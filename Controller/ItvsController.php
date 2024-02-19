<?php
require_once '../Model/Itvs.php';

class ItvsController {
    public static function buscarItvs($id){
        try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM itvs WHERE id='$id'");
            if ($result->num_rows){
                $reg = $result->fetch_object();
                $p = new Itvs($reg->id, $reg->provincia, $reg->localidad, $reg->direccion, $reg->telefono);
            }
            else{
                $p=0;
            }
        } catch (Exception $ex) {
            $p=false;
        }
        return $p;
    }
    
    public static function recuperaTodos(){
         try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM itvs");
            if ($result->num_rows){
                while ($reg=$result->fetch_object()){
                    $p = new Itvs($reg->id, $reg->provincia, $reg->localidad, $reg->direccion, $reg->telefono);
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
    
    public static function recuperaTodosBuscados($provincia){
         try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM itvs where provincia='$provincia'");
            if ($result->num_rows){
                while ($reg=$result->fetch_object()){
                    $p = new Itvs($reg->id, $reg->provincia, $reg->localidad, $reg->direccion, $reg->telefono);
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
}
