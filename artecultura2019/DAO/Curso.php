<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Curso {

    private $idCurso;
    private $cursoNombre;
    private $cursoCreditos;
    private $cursoEstado;
    
    public function __construct($id = "", $nombre = "", $creditos = "",$estado="1") {
        $this->idCurso=$id;
        $this->cursoNombre = $nombre;
        $this->cursoCreditos= $creditos;
        $this->cursoEstado = $estado;
    }
    public function getId() {
        return $this->idCurso;
    }

    public function getCursoNombre() {
        return $this->cursoNombre;
    }

    public function getCursoCreditos() {
        return $this->cursoCreditos;
    }
    public function  getCursoEstado(){
        return $this->cursoEstado;
    }

    public function __toString() {
        return $this->idCurso." ".$this->cursoNombre." ".$this->cursoEstado;
    }

}