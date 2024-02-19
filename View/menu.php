<?php
session_start();
if (isset($_SESSION['provincia'])){
    ?>
<html>
        <head>
            <title>Menu</title>
        </head>
        <body>
            <p>Hola Administrador de <?php echo $_SESSION['provincia']; ?></p>
            <p>Telefono: <?php echo $_SESSION['telefono']; ?></p>
            <form action="" method="POST">
                <input type="submit" name="cerrar" value="Cerrar Sesion">
            </form>
            <div style="text-align: center">
                <h1>Gestión de citas de las ITV de <?php echo $_SESSION['provincia']; ?></h1>
                <a href="nuevaCita.php">Registrar nueva cita</a><br>
                <a href="listaItvs.php">Listado de sedes de ITV</a><br>
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

