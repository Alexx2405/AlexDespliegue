

<?php
//USuario Admin Alex -12345
//usuario - Cliente Luis - 12345
//usuario -invitado Alberto - 12345
session_start();
require 'Conexion.php';
//COMPROBANDO SI EXISTE SESSION.
if(!$_SESSION["$_COOKIE[nombre_usuario]"]){
    header('Location:./iniciar_sesion.php');
}
if (isset($_POST['insertar'])) {
$conexion = new Mysqli("localhost", "root", "", "espectaculos");
    $datosEspectaculo = array(
        "nombre" => htmlspecialchars($_POST['nombre']),
        "cdespec" => htmlspecialchars($_POST['cdespec']),
        "tipo" => htmlspecialchars($_POST['tipo']),
        "estrellas" => htmlspecialchars($_POST['estrellas']),
        "cdgru" => htmlspecialchars($_POST['cdgru']));
    
    //var_dump($datosEspectaculo);
    try {
        $inserccion = $conexion->query("INSERT INTO espectaculo (cdespec,nombre,tipo,estrellas,cdgru)"
                . " VALUES('$datosEspectaculo[cdespec]','$datosEspectaculo[nombre]"
                . "','$datosEspectaculo[tipo]','$datosEspectaculo[estrellas]','$datosEspectaculo[cdgru]')");
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    if ($inserccion) {
        echo 'Enhorabuena , se ha insertado correctamente';
    } else {
        echo 'Ha ocurrido un error.';
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
        <form action="alta_espectaculos.php" method="post">

            <label>Nombre: </label>
            <input type="text" name="nombre">
            <br>
            <label>CDESPEC: </label>
            <input type="text" name="cdespec">
            <br>
            <label>Tipo: </label>
            <input type="text" name="tipo">
            <br>
            <label>Estrellas: </label>
            <input type="text" name="estrellas">
            <br>
            <label>cdgru: </label>
            <input type="text" name="cdgru">
            <button name="insertar">Insertar</button>

        </form>
       <a href="./iniciar_sesion.php" name="cerrar_Sesion">Cerrar Sessión</a>
            <?php
            if(isset($_POST['cerrar_Sesion'])){
                unset($_SESSION["$_COOKIE[nombre_usuario]"]);
               
                $conexion->close();
            }
            ?>
    </body>
</html>
