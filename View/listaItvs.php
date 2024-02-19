<?php

   require_once '../Model/Itvs.php';
   require_once '../Controller/ItvsController.php';  
session_start();
if (isset($_SESSION['provincia'])){
    ?>
<html>
        <head>
            <title>Lista Itvs</title>
        </head>
        <body>
            <p>Hola Administrador de <?php echo $_SESSION['provincia']; ?></p>
            <p>Telefono: <?php echo $_SESSION['telefono']; ?></p>
            <form action="" method="POST">
                <input type="submit" name="cerrar" value="Cerrar Sesion">
            </form><br>
            <a href="menu.php">Volver al menú</a>
            <div>
                <h1>Citas de las ITV de la provincia de  <?php echo $_SESSION['provincia']; ?></h1>
                <table border="1">
                    <tr>
                        <td>Localidad</td>
                        <td>Direccion</td>
                        <td>Citas</td>
                    </tr>
                    <?php
                    $itvs = ItvsController::recuperaTodosBuscados($_SESSION['provincia']);
                    if ($itvs==0){
                        echo 'No hay citas en esta provincia';
                    }else{
                        foreach ($itvs as $p){
                            echo "<tr>";
                            echo "<td>".$p->localidad."</td>";
                            echo "<td>".$p->direccion."</td>";
                            echo "<td>"
                            . "<form action='citas.php' method='POST'>
                                    <input type='hidden' name='id' value='".$p->id."'>
                                    <input type='hidden' name='localidad' value='".$p->localidad."'>
                                    <input type='submit' name='citas' value='Mis citas'>
                                </form>"
                                    . "</td>";
                            echo "</tr>";
                        }
                    }
                        
                    ?>
                </table>
            </div>
        </body>
    </html>

<?php
    if (isset($_POST['cerrar'])){
        session_destroy();
        header("location:index.php");
    }
}else{
    header("location:index.php");
}

