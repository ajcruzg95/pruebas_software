<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModeloDia extends Modelo implements Operations{
    public function __construct() {
        parent::__construct();
    }

    public function addRegistro($registro) {
        $temp = new Dia();
        $temp = $registro;
        $sql = "INSERT INTO `dia`"
                . "(`DiaDescripcion`,"
                . " `DiaEstado`) "
                . "VALUES "
                . "('".$temp->getDiaDescripcion()."',"
                . "".$temp->getDiaEstado().")";
        parent::getConn()->query($sql);
        
    }

    public function delRegistroPorId($id) {
         $sql = "UPDATE `dia` SET `DiaEstado`=0 WHERE `IdDia`=".$id;
        parent::getConn()->query($sql);
    }

    public function getLista() {
         $sql = "SELECT * FROM `dia` WHERE `DiaEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `dia` WHERE `IdDia`=" . $id;

        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
         $temp = new Dia();
        $temp = $registro;
        $sql="UPDATE `dia` SET "
                . "`DiaDescripcion`='".$temp->getDiaDescripcion()."' 
                
                   WHERE `IdDia`=".$temp->getId();
        
        parent::getConn()->query($sql);
        return $sql;
    }

}