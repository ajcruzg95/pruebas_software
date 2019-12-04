<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario {

    private $IdUsuario;
    private $IdTipoUsuario;
    private $UsuarioNombre;
    private $UsuarioApellido;
    private $UsuarioContrasenia;
    private $UsuarioEstReg;

    public function __construct($idUsu="",$idTipo="",$usuNombre="",$usuApellido="",$estado="1") {
        $this->IdUsuario=$idUsu;
        $this->IdTipoUsuario=$idTipo;
        $this->UsuarioNombre=$usuNombre;
        $this->UsuarioApellido=$usuApellido;
        $this->UsuarioEstReg=$estado;
    }
    public function contrasenia($contrasenia){
        $this->UsuarioContrasenia=$contrasenia;
    }
    public function getId(){
        return $this->IdUsuario;
    }
    public function getTipoUsuario() {
        return $this->IdTipoUsuario;
    }
    public function getNombre() {
        return $this->UsuarioNombre;
    }
    public function getApellido() {
        return $this->UsuarioApellido;
    }
    public function getContrasenia() {
        return $this->UsuarioContrasenia;
    }
    public function getEstado() {
        return $this->UsuarioEstReg;
    }
    
}
