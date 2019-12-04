<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Facultad{
    private $idFacultad;
    private $facultadNombre;
    private $facultadEstado;
    
    public function __construct($id="",$nombre="",$estado="1") {
        $this->idFacultad=$id;
        $this->facultadNombre=$nombre;
        $this->facultadEstado=$estado;
    }
    public function getId(){
        return $this->idFacultad;
    }
    
    public function getFacultadNombre(){
        return $this->facultadNombre;
    }
    
    public function getFacultadEstado(){
        return $this->facultadEstado;
    }
}

