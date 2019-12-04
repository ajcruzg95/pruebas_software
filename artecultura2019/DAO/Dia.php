<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dia{
    private $idDia;
    private $diaDescripcion;
    private $diaEstado;
    
    public function __construct($id="",$descripcion="",$estado="1") {
        $this->idDia =$id;
        $this->diaDescripcion = $descripcion;
        $this->diaEstado=$estado;
    }
    public function getId(){
        return $this->idDia ;
    }
    public function getDiaDescripcion(){
        return $this->diaDescripcion;
    }
    public function  getDiaEstado(){
        return $this->diaEstado;
    }
}