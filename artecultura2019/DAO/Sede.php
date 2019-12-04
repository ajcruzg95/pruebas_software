<?php

class Sede{
    private $idSede;
    private $sedeNombre;
    private $sedeActivo;
    private $sedeEstado;
    
    public function __construct($id="",$nombre="",$activo="0",$estado="1") {
        $this->idSede =$id;
        $this->sedeNombre= $nombre;
        $this->sedeActivo=$activo;
        $this->sedeEstado=$estado;
    }
    public function getId(){
        return $this->idSede ;
    }
    public function getActivo() {
        return $this->sedeActivo;
    }
    public function getSedeNombre(){
        return $this->sedeNombre;
    }
    public function  getSedeEstado(){
        return $this->sedeEstado;
    }
}
