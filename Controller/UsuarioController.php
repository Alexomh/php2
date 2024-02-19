<?php
require_once '../Model/Usuario.php';

class UsuarioController {
    
    public static function buscarUsuario($user){
        try {
            $conex = new Conexion;
            $result=$conex->query("SELECT * FROM usuario WHERE user='$user'");
            if ($result->num_rows){
                $reg = $result->fetch_object();
                $p = new Usuario($reg->provincia, $reg->nombre, $reg->telefono, $reg->user, $reg->pass);
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
