
<?php
//USuario Admin Alex -12345
//usuario - Cliente Luis - 12345
//usuario -invitado Alberto - 12345
session_start();
//COMPROBANDO SI EXISTE SESIÓN
require 'Conexion.php';
if (!$_SESSION["$_COOKIE[nombre_usuario]"]) {
    header('Location:./iniciar_sesion.php');
}
//------------CONEXION BDD -------------------------------
$conexion = new Conexion();
$espectaculos = $conexion->query("SELECT nombre,estrellas,tipo FROM espectaculo ORDER BY estrellas DESC");
?>
<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <ul>   
            <li style="color: blue">Nombre-Estrellas-Tipo</li>
            <?php
            while ($espectaculo=$espectaculos->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <li><?php echo "$espectaculo[nombre]-$espectaculo[estrellas]-$espectaculo[tipo]" ?></li>
                <?php
            }
            ?>
            <a href="./iniciar_sesion.php" name="cerrar_Sesion">Cerrar Sesión</a>
            <?php
            //------------CIERRE DE CONEXIÓN.
            if (isset($_POST['cerrar_Sesion'])) {
                unset($_SESSION["$_COOKIE[nombre_usuario]"]);
                
                $espectaculos = null;
                $conexion = null;
            }
            ?>

        </ul>

    </body>
</html>
