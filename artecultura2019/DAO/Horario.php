<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Horario{
    private $idHorario;
    private $grupo;
    private $lugar;
    private $dia;
    private $horaEntrada;
    private $horaSalida;
    private $horarioEstado;
    
    public function __construct($id="",Grupo $grupo=NULL,Lugar $lugar=NULL,Dia $dia=NULL,$horaEntrada="",$horaSalida="",$horarioEstado="1") {
        $this->idHorario=$id;
        $this->grupo=new Grupo();
        $this->grupo=$grupo;
        
        $this->lugar=new Lugar();
        $this->lugar=$lugar;
        
        $this->dia=new Dia();
        $this->dia=$dia;
        
        $this->horaEntrada=$horaEntrada;
        $this->horaSalida=$horaSalida;
        $this->horarioEstado=$horarioEstado;
    }
    public function getId() {
        return $this->idHorario;
    }
    public function getGrupo() {
        return $this->grupo;
    }
    public function getLugar() {
        return $this->lugar;
    }
    public function getDia() {
        return $this->dia;
    }
    public function getHoraEntrada() {
        return $this->horaEntrada;
    }
    public function getHoraSalida() {
        return $this->horaSalida;
    }
    public function getHorarioEstado() {
        return $this->horarioEstado;
    }
}



