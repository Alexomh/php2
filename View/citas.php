<?php
   require_once '../Model/Vehiculo.php';
   require_once '../Controller/VehiculoController.php'; 
   require_once '../Model/Citas.php';
   require_once '../Controller/CitasController.php';
session_start();
if (isset($_SESSION['provincia'])){
    ?>
<html>
        <head>
            <title>Citas</title>
        </head>
        <body>
            <p>Hola Administrador de <?php echo $_SESSION['provincia']; ?></p>
            <p>Telefono: <?php echo $_SESSION['telefono']; ?></p>
            <form action="" method="POST">
                <input type="submit" name="cerrar" value="Cerrar Sesion">
            </form><br>
            <a href="menu.php">Volver al menú</a>
            <div style="text-align: center">
                <h1>Vehiculos con cita en la ITV de   <?php echo $_POST['localidad']; ?></h1>
                <table border="1">
                    <tr>
                        <td>Matrícula</td>
                        <td>Marca</td>
                        <td>Modelo</td>
                        <td>Fecha</td>
                        <td>Hora</td>
                        <td>Ficha Técnica</td>
                    </tr>
                    <?php
                    $citas = CitasController::recuperaTodosBuscados($_POST['id']);
                    
                    
                        foreach ($citas as $p){
                            echo "<tr>";
                            $coches = VehiculoController::buscarVehiculo($p->matricula);
                            echo "<td>".$coches->matricula."</td>";
                            echo "<td>".$coches->marca."</td>";
                            echo "<td>".$coches->modelo."</td>";
                            echo "<td>".$p->fecha."</td>";
                            echo "<td>".$p->hora."</td>";
                            echo "<td><a href='mostrar.php?ruta=".$p->ficha."'>".$p->ficha."</a></td>";
                            echo "</tr>";
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

