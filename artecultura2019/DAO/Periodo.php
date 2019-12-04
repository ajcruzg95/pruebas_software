<?php
class Periodo{
    private $idPeriodo;
    private $idSede;
    private $periodoAnio;
    private $periodoNumero;
    private $periodoActivo;
    private $periodoEstado;
    
    public function __construct($id="",$sede="",$anio="",$numero="",$activo="0",$estado="1") {
        $this->idPeriodo =$id;
        $this->idSede=$sede;
        $this->periodoAnio= $anio;
        $this->periodoNumero=$numero;
        $this->periodoActivo=$activo;
        $this->periodoEstado=$estado;
    }
    public function getId(){
        return $this->idPeriodo ;
    }
    public function getSede(){
        return $this->idSede;
    }
    public function getAnio(){
        return $this->periodoAnio;
    }
    public function  getNumero(){
        return $this->periodoNumero;
    }
    public function getActivo(){
        return $this->periodoActivo;
    }
    public function getEstado(){
        return $this->periodoEstado;
    }
}
