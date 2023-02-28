

<?php
//USuario Admin Alex -12345
//usuario - Cliente Luis - 12345
//usuario -invitado Alberto - 12345
session_start();
//COMPROBANDO SI EXISTE SESIÓN
require './Conexion.php';
if (!$_SESSION["$_COOKIE[nombre_usuario]"]) {
    header('Location:./iniciar_sesion.php');
}



    $conexion = new Conexion();
if (isset($_POST['reservar'])) {

    if ($_POST['espectaculo']) {
        $espectaculo = $_POST['espectaculo'];
        echo "se ha reservado $espectaculo";
    } else {
        echo "no se ha seleccionado tipo espectaculo";
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="reservar_espectaculos.php" method="post">
            <?php
            $espectaculos = $conexion->query("SELECT nombre FROM espectaculo");
            ?>
            <label>Espectáculo</label>
            <select name="espectaculo">
                <?php while ($nombre_Espec = $espectaculos->fetch(PDO::FETCH_ASSOC)['nombre']) { ?>
                    <option value="<?php echo $nombre_Espec ?>"><?php echo $nombre_Espec ?></option>

                    <?php
                }
                ?>
            </select>

            <button name="reservar">Reservar</button>

        </form>

        <a href="./iniciar_sesion.php" name="cerrar_Sesion">Cerrar Sesión</a>
        <?php
        if (isset($_POST['cerrar_Sesion'])) {
            unset($_SESSION["$_COOKIE[nombre_usuario]"]);

            $conexion = null;
        }
        ?>
    </body>
</html>
