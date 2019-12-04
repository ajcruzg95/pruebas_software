<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AlumnoGrupo{
    private $idAlumnoGrupo;
    private $grupo;
    private $alumno;
    private $alumnoGrupoEstado;
    
    public function __construct($id="",Grupo $grupo=NULL,Alumno $alumno=NULL,$estado="1") {
        $this->idAlumnoGrupo=$id;
        $this->grupo= new Grupo();
        $this->grupo=$grupo;
        
        $this->alumno=new Alumno();
        $this->alumno=$alumno;
        $this->alumnoGrupoEstado=$estado;
    }
    public function getId() {
        return $this->idAlumnoGrupo;
    }
    public function getGrupo() {
        return $this->grupo;
    }
    public function getAlumno() {
        return $this->alumno;
    }
    public function getEstado() {
        return $this->alumnoGrupoEstado;
    }
    function setIdAlumnoGrupo($idAlumnoGrupo) {
        $this->idAlumnoGrupo = $idAlumnoGrupo;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    function setAlumno($alumno) {
        $this->alumno = $alumno;
    }

    function setAlumnoGrupoEstado($alumnoGrupoEstado) {
        $this->alumnoGrupoEstado = $alumnoGrupoEstado;
    }


}
