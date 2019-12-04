<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Escuela{
    private $idEscuela;
    private $facultad;
    private $nombreEscuela;
    private $escuelaEstado;
    
    public function __construct($idEscuela="",Facultad $facultad=NULL,$nombre="",$estado="1") {
        $this->idEscuela=$idEscuela;
        $this->facultad = $facultad;
        $this->nombreEscuela=$nombre;
        $this->escuelaEstado=$estado;
    }
    public function getId() {
        return $this->idEscuela;
    }
    public function getFacultad() {
        return $this->facultad;
    }
    public function getNombre() {
        return $this->nombreEscuela;
    }
    public function getEstado() {
        return $this->escuelaEstado;
    }
    
    
}
