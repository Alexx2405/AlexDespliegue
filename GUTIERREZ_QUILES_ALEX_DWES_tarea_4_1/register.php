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
        <?php
        // put your code here
        require_once "./funciones.php";
        require 'Conexion.php';
        ?>
        <div id="parteFormulario">
            <form action="register.php" method="post">
                <label for="login">Usuario</label>
                <input type="text" name="login" id="login">
                <br>
                <label for="password">Contraseña</label>
                <input type="text" name="password" id="password">
                <button name="registrar">Registrar</button>


            </form>
        </div>
<?php
if (isset($_POST['registrar'])) {
    $conexion = new Conexion("localhost","espectaculos","root","");
    ;
    $claveInput = htmlspecialchars($_POST['password']);
    $nameInput = htmlspecialchars($_POST['login']);
    $claveHash = password_hash($claveInput, PASSWORD_BCRYPT);

    insertarUsuario($nameInput, $claveHash, $conexion);
    ?>

            <?php
        }
        ?>
        <a href="./iniciar_sesion.php" style="color:white;background-color:black">¿Iniciar Sesión?</a>
    </body>

</html>