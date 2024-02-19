<?php
   require_once '../Model/Citas.php';
   require_once '../Controller/CitasController.php';  
   require_once '../Model/Vehiculo.php';
   require_once '../Controller/VehiculoController.php';  
   require_once '../Model/Itvs.php';
   require_once '../Controller/ItvsController.php';  
session_start();
if (isset($_SESSION['provincia'])){
    ?>
<html>
        <head>
            <title>Nueva Cita</title>
        </head>
        <body>
            <p>Hola Administrador de <?php echo $_SESSION['provincia']; ?></p>
            <p>Telefono: <?php echo $_SESSION['telefono']; ?></p>
            <form action="" method="POST">
                <input type="submit" name="cerrar" value="Cerrar Sesion">
            </form><br>
            <a href="menu.php">Volver al menú</a>
            <div style="text-align: center">
                <h1>Gestion de citas de las ITV de  <?php echo $_SESSION['provincia']; ?></h1>
                <form action="" method="POST">
                    Matricula: <input type="text" name="matricula">
                    <input type="submit" name="buscar" value="Buscar">
                </form>
            </div>
            <?php
            if (isset($_POST['buscar'])){
                $vehiculo = VehiculoController::buscarVehiculo($_POST['matricula']);
                if ($vehiculo == '0'){
                    echo "<p style='color: red;'>No existe ningún vehiculo con esa matricula en la base de datos</p>";
                }
                else{
                    $cita = CitasController::buscarCitas($_POST['matricula']);
                
                        if ($cita=='0'){
                            //Nueva cita

                            ?>
                <div style="text-align: center">
                    <h2>Datos del vehiculo</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        Matricula: <input type="text" name="matricula" value="<?php echo $vehiculo->matricula; ?>" onlyread>
                        Marca: <input type="text" name="marca" value="<?php echo $vehiculo->marca; ?>" onlyread><br>
                        Modelo: <input type="text" name="modelo" value="<?php echo $vehiculo->modelo; ?>" onlyread>
                        Color: <input type="text" name="color" value="<?php echo $vehiculo->color; ?>" onlyread><br>
                        Plazas: <input type="text" name="plazas" value="<?php echo $vehiculo->plazas; ?>" onlyread>
                        Fecha última cita: <input type="text" name="fechaUltima" value="<?php echo $vehiculo->fecha_ultima_revision; ?>" onlyread><br>
                        Elegir ITV: 
                        <select name="itvs">
                            <?php
                            $itvs = ItvsController::recuperaTodos();
                            foreach ($itvs as $p){
                                echo "<option type='chekbox' value='".$p->id."'>".$p->localidad."-".$p->direccion."</option>";
                            }

                            ?>
                        </select><br>
                        Fecha: <input type="date" name="fecha"><br>
                        Hora: <input type="time" name="hora" required><br>
                        Ficha técnica del vehiculo: <input type="file" name="foto"><br>
                        <input type="submit" name="registrar" value="Registrar Cita">
                    </form>
                </div>
                            <?php
                        }
                        else{
                            $itv = ItvsController::buscarItvs($cita->id_itv);
                            echo '<p>Ya tiene una cita el dia '.$cita->fecha.' a las '.$cita->hora.
                                    ' en la ITV de '.$itv->localidad.' en la provincia de '.$itv->provincia.'</p>';
                            ?>
                <form action="" method="POST">
                    <input type="hidden" name="matricula" value="<?php echo $_POST['matricula']; ?>">
                    <input type="submit" name="anular" value="Anular">
                </form>
                            <?php
                        }
                    
                }
                
            }
            if (isset($_POST['anular'])){
                $anular = CitasController::borrarCita($_POST['matricula']);
                echo $anular." CITA ANULADA";
            }
            if (isset($_POST['registrar'])){
                if (is_uploaded_file($_FILES['foto']['tmp_name'])){
                    $fich = time()."-".$_POST['matricula']."-".$_FILES['foto']['name'];
                    if (!preg_match('/^.*[.jpg]$/', $fich)){
                        echo 'ERROR';
                    }else{
                        
                        $ruta = "fichas/".$fich;
                        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
                        $cita = new Citas($_POST['matricula'], $_POST['itvs'], $_POST['fecha'], $_POST['hora'], $ruta);
                        $subir = CitasController::insertar($cita);
                        echo $subir.' Cita Subida';
                    }
                
                }else{
                    echo "Error al subir el fichero";
                }
                
                
            }
            ?>
            
            
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

