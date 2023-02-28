<?php



/**
 * 
 * Registra un nuevo usuario con los parámetros introducidos.
 * @param mixed $loginn clave primaria Login
 * @param mixed $password contraseña
 * @return bool devuelve true si se ha registrado usuario y false si no se ha completado la operación.
 */
function insertarUsuario($loginn, $password,$conexionBDD)
{
    try {
        
        $conexionBDD->beginTransaction();
        $insertarUser = $conexionBDD->exec("INSERT INTO usuarios (login,clave,id_rol) VALUES('$loginn','$password',2)");
        $insertado = false;
        if ($insertarUser > 0) {
            $insertado = true;
            $conexionBDD->commit();

        }
        return $insertado;
    } catch (PDOException $th) {
        echo $th->getMessage();
        $conexionBDD->rollBack();
       
    }
}

/**
 * Obtiene la contraseña del usuario indicado.
 * @param mixed $login clave primaria (usuario).
 * @return mixed Devuelve la clave del usuario.
 */
function getPassword($login,$conectar)
{

    try {
        
       
        $user = $conectar->query("SELECT clave from usuarios where login='$login'");
        
        $passwordUser = $user->fetch(PDO::FETCH_NUM)[0];
        //echo $passwordUser;
        return $passwordUser;
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

}
/**
 * 
 * Actualiza la contraseña encriptada para cambiar los valores HASH .
 * @param mixed $login clave primaria
 * @param mixed $password contraseña a encriptar y actualizarla
 * @return bool devuelve true si se ha realizado y false si no se ha completado.
 */
function setPassword($login, $password,$conexion)
{
    try {
        
        $conexion->beginTransaction();
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $update = $conexion->exec("UPDATE usuarios SET clave='$passwordHash' where login='$login'");
        $actualizado = false;
        if ($update > 0) {
            $actualizado = true;
            $conexion->commit();
            
        }else {
           $conexion->rollBack();
        }
        return $actualizado;

    } catch (PDOException $th) {
        echo $th->getMessage();
        $conexion->rollBack();
    }

}
/**
Obtiene el cargo de un usuario a través del login clave primaria de la tabla.

@param $login - nombre de usuario para consultar el Cargo de ese usuario.
@param $conexion - Conexión de la base de datos con la que se trabaja.
@throws PDOException - Conexión indicada tiene un problema.
@return Cargo del Usuario Indicado.
 
*/
function getCargo($login,$conexion){
    try {
        
        $cargo=$conexion->query("SELECT id_rol from usuarios where login='$login'");
        $numCargo=$cargo->fetch(PDO::FETCH_NUM)[0];
       
        
        switch ($numCargo) {
            case 1:
                $cargoSalida="admin";
                break;
            case 2:
                $cargoSalida="user";
                break;
            case 3:
                $cargoSalida="invitado";
                break;
                
        }
                
            return $cargoSalida;
        
    } catch (PDOException $th) {
        throw new PDOException('Ha ocurrido un problema con la conexión');
    }

}
/**
 * Comprueba si el login existe en la base de datos.
 * @param mixed $login - nombre de usuario.
 * @return bool  devuelve true - si existe - false no existe.
 */
function getLogin($login,$conexion){
    try{
    $existeLogin=false;
    
    $consulta=$conexion->query("SELECT login from usuarios where login='$login'");
    $consultaFetch=$consulta->fetch(PDO::FETCH_NUM);
    if($consultaFetch){
        $existeLogin=true;
    }
    return $existeLogin;
    }catch(PDOException $th){
        echo $th->getMessage();
        

    }

}

