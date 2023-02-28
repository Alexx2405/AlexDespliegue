<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author Alex
 */
class Conexion extends PDO {

    private $nombreDataBase="espectaculos";
    private $nombreUsuario="root";
    private $contrasenia="";
    private $host="localhost";

    public function __construct() {
        parent::__construct("mysql:host=$this->host;dbname=$this->nombreDataBase","$this->nombreUsuario","$this->contrasenia");
        
        

    }

    public function setNombreDataBase($nombreDataBase) {
        $this->nombreDataBase = $nombreDataBase;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function getNombreDataBase() {
        return $this->nombreDataBase;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

}
