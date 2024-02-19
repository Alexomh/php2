<?php
   require_once '../Model/Usuario.php';
   require_once '../Controller/UsuarioController.php';     
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
    </head>
    <body style="text-align: center">
        <h1>Gestión de Citas ITV de Andalucia</h1>
        <form action="" method="POST">
            Usuario: <input type="text" name="usuario"><br>
            Clave: <input type="password" name="clave"><br>
            <input type="submit" name="acceder" value="Acceder"><br>
        </form>
        <?php
        if (isset($_POST['acceder'])){
            $usuario = UsuarioController::buscarUsuario($_POST['usuario']);
    
            if ($usuario === false){
                echo 'Error en la base de datos';
            }
            else{
                if (password_verify($_POST['clave'], $usuario->getPass())){
                    session_start();
                    $_SESSION['provincia'] = $usuario->provincia;
                    $_SESSION['telefono'] = $usuario->telefono;
                    header("location:menu.php");
                }
                else{
                    echo "<p style='color: red;'>Usuario o clave incorrecta</p>";
                }
            }
        }
        ?>
    </body>
</html>
