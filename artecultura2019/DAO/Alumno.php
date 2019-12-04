<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 8 atributos
 * 
 */

class BuilderAlumno {

    //requeridos
    public $idAlumno;
    public $alumnoNombre;
    public $alumnoApellido;
    public $alumnoCodigo;
    public $escuela;
    //opcionales
    public $alumnoCorreo;
    public $alumnoCelular;
    public $alumnoContra;
    public $alumnoEstado;

    public function __construct($id = "",$escuela="", $nombre = "", $apellido = "", $codigo = "") {
        $this->idAlumno = $id;
        $this->alumnoNombre = $nombre;
        $this->alumnoApellido = $apellido;
        $this->alumnoCodigo = $codigo;
        $this->escuela = $escuela;
    }

    public function correo($correo) {
        $this->alumnoCorreo = $correo;
    }

    public function celular($celular) {
        $this->alumnoCelular = $celular;
    }

    public function contrasenia($contra) {
        $this->alumnoContra = $contra;
    }

    public function estado($estado) {
        $this->alumnoEstado = $estado;
    }

    public function build() {
        return new Alumno($this);
    }

}

class Alumno {

    private $idAlumno;
    private $alumnoNombre;
    private $alumnoApellido;
    private $alumnoCodigo;
    private $alumnoCorreo;
    private $alumnoCelular;
    private $alumnoContra;
    private $alumnoEstado;

    public function __construct(BuilderAlumno $builder = NULL) {
        if ($builder != NULL) {
            $this->idAlumno = $builder->idAlumno;
            $this->alumnoNombre = $builder->alumnoNombre;
            $this->alumnoApellido = $builder->alumnoApellido;
            $this->alumnoCodigo = $builder->alumnoCodigo;
            $this->alumnoCorreo = $builder->alumnoCorreo;
            $this->alumnoCelular = $builder->alumnoCelular;
            $this->alumnoContra = $builder->alumnoContra;
            $this->alumnoEstado = $builder->alumnoEstado;
            $this->escuela  = $builder->escuela;
        }
    }

    public function getId() {
        return $this->idAlumno;
    }

    public function getAlumnoNombre() {
        return $this->alumnoNombre;
    }

    public function getAlumnoApellido() {
        return $this->alumnoApellido;
    }

    public function getAlumnoCodigo() {
        return $this->alumnoCodigo;
    }

    public function getEscuela() {
        return $this->escuela;
    }
    public function getAlumnoCorreo() {
        return $this->alumnoCorreo;
    }

    public function getAlumnoCelular() {
        return $this->alumnoCelular;
    }

    public function getAlumnoContrasenia() {
        return $this->alumnoContra;
    }

    public function getAlumnoEstado() {
        return $this->alumnoEstado;
    }

    public function __toString() {
        return $this->idAlumno . " " . $this->alumnoNombre . " " . $this->alumnoEstado;
    }

}

/*
  $buildAlumno = new BuilderAlumno(12, "david", "deza", "20130873");
  $buildAlumno->correo("daviddeza@gmail.com");
  $buildAlumno->celular(941264670);
  $buildAlumno->contrasenia("ladesiempre");
  $buildAlumno->estado(1);
  //$nuevo = new Alumno();
  $nuevo = $buildAlumno->build();
  echo $nuevo;
 */
