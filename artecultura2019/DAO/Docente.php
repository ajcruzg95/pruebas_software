<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BuilderDocente {

    //requeridos
    public $idDocente;
    public $docenteNombre;
    public $docenteApellido;
    public $docenteCodigo;
    //opcionales
    public $docenteDNI;
    public $docenteContra;
    public $docenteCorreo;
    public $docenteCelular;
    public $docenteEstado;

    public function __construct($id = "", $nombre = "", $apellido = "", $codigo = "") {
        $this->idDocente = $id;
        $this->docenteNombre = $nombre;
        $this->docenteApellido = $apellido;
        $this->docenteCodigo = $codigo;
    }

    public function dni($dni) {
        $this->docenteDNI = $dni;
    }

    public function correo($correo) {
        $this->docenteCorreo = $correo;
    }

    public function celular($celular) {
        $this->docenteCelular = $celular;
    }

    public function contrasenia($contra) {
        $this->docenteContra = $contra;
    }

    public function estado($estado) {
        $this->docenteEstado = $estado;
    }

    public function build() {
        return new Docente($this);
    }

}

class Docente {

    private $idDocente;
    private $docenteNombre;
    private $docenteApellido;
    private $docenteCodigo;
    private $docenteDNI;
    private $docenteCorreo;
    private $docenteCelular;
    private $docenteContra;
    private $docenteEstado;

    public function __construct(BuilderDocente $builder = NULL) {
        if ($builder != NULL) {

            $this->idDocente = $builder->idDocente;
            $this->docenteNombre = $builder->docenteNombre;
            $this->docenteApellido = $builder->docenteApellido;
            $this->docenteCodigo = $builder->docenteCodigo;
            $this->docenteCorreo = $builder->docenteCorreo;
            $this->docenteCelular = $builder->docenteCelular;
            $this->docenteContra = $builder->docenteContra;
            $this->docenteEstado = $builder->docenteEstado;
            $this->docenteDNI = $builder->docenteDNI;
        }
    }

    public function getId() {
        return $this->idDocente;
    }

    public function getDocenteNombre() {
        return $this->docenteNombre;
    }

    public function getDocenteApellido() {
        return $this->docenteApellido;
    }

    public function getDocenteCodigo() {
        return $this->docenteCodigo;
    }

    public function getDocenteCorreo() {
        return $this->docenteCorreo;
    }

    public function getDocenteCelular() {
        return $this->docenteCelular;
    }

    public function getDocenteContrasenia() {
        return $this->docenteContra;
    }

    public function getDocenteDni() {
        return $this->docenteDNI;
    }

    public function getDocenteEstado() {
        return $this->docenteEstado;
    }

    public function __toString() {
        return $this->idDocente . " " . $this->docenteNombre . " " . $this->docenteEstado;
    }

}
