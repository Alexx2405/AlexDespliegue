

<?php
session_start();
//Alex-12345
//USuario Admin Alex -12345
//usuario - Cliente Luis - 12345
//usuario -invitado Alberto - 12345
// diferencia entre unset y session_destroy es que el unset elimina el valor de la sesión y no elimina la sesión.
//Y el session_destroy elimina la session y el valor también no solo elimina el valor.
require './Conexion.php';
require_once './funciones.php';

if (isset($_POST['iniciarSesion'])) {
    $conexion = new Conexion();
    $contrasenia_Introducida = htmlspecialchars($_POST['contrasenia']);
    $usuario_introducido = htmlspecialchars($_POST['usuario']);
    $consulta = $conexion->query("SELECT * FROM usuarios where login='$usuario_introducido'")->fetch()[0];
    
    if ($consulta) {

        $contrasenia_user = $conexion->query("SELECT clave from usuarios where login='$usuario_introducido'")->fetch()[0];

        if (password_verify($contrasenia_Introducida, $contrasenia_user)) {
            echo "usuario correcto";
            $cargos_user = $conexion->query("SELECT id_rol from usuarios where login='$usuario_introducido'")->fetch()[0];
            echo $cargos_user;
            setcookie("nombre_usuario", $usuario_introducido);
            switch ($cargos_user) {
                case 1:
                    $cargo = 'administrador';
                    $_SESSION["$usuario_introducido"]['nombre'] = $usuario_introducido;
                    $_SESSION["$usuario_introducido"]['cargo'] = $cargo;
                    header('Location:./alta_espectaculos.php');
                    break;
                case 2:
                    $cargo = 'usuario';

                    $_SESSION["$usuario_introducido"]['nombre'] = $usuario_introducido;
                    $_SESSION["$usuario_introducido"]['cargo'] = $cargo;
                    header('Location:./reservar_espectaculos.php');
                    // header:location('reservar_espectaculos.php');
                    break;
                case 3:
                    $cargo = 'invitado';

                    $_SESSION["$usuario_introducido"]['nombre'] = $usuario_introducido;
                    $_SESSION["$usuario_introducido"]['cargo'] = $cargo;
                    header('Location:./ver_espectaculos.php');
                    break;
            }
        } else {
            echo 'usuario o contraseña incorrecta';
        }
    } else {
        echo "El usuario introducido no existe";
    }
}
?>

<!DOCTYPE html>
<html lang = "en">

    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>ALEX TAREA3</title>
    </head>

    <body>
<?php ?>
        <form action="iniciar_sesion.php" method="post">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="login">
            <br>
            <label for="contrasenia">Contraseña</label>
            <input type="text" name="contrasenia" id="contrasenia">
            <input type="submit" value="Iniciar Sesión" name="iniciarSesion">


        </form>

        <a href="./register.php" style="color:white;background-color:black">¿Registrarte?</a>

    </body>

</html>