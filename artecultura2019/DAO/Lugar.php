<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Lugar{
    private $idLugar;
    private $lugarNombre;
    private $lugarEstado;
    
    public function __construct($id="",$nombre="",$estado="1") {
        $this->idLugar=$id;
        $this->lugarNombre=$nombre;
        $this->lugarEstado=$estado;
    }
    public function getId(){
        return $this->idLugar;
    }
    
    public function getLugarNombre(){
        return $this->lugarNombre;
    }
    
    public function getLugarEstado(){
        return $this->lugarEstado;
    }
}
