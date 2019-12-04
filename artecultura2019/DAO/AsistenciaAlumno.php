<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AsistenciaAlumno{
    private $idAsistenciaAlumno;
    private $IdGrupo;
    private $alumno;
    private $estado;
    
    public function __construct($id="",AsistenciaDocente $asistDoc=NULL,Alumno $alumno=NULL,$estado="1") {
        $this->idAsistenciaAlumno=$id;
        $this->IdGrupo = new Grupo();
        $this->IdGrupo = $asistDoc;
        
        $this->alumno=new Alumno();
        $this->alumno=$alumno;
        $this->estado=$estado;
    }
    public function getId(){
        return $this->idAsistenciaAlumno;
    }
    public function getIdGrupo() {
        return $this->getIdGrupo();
    }
    
    public function getAlumno() {
        return $this->alumno;
    }
    public function getEstado() {
        return $this->estado;
    }
        
    
}
