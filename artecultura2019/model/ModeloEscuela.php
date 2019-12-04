<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ModeloEscuela extends Modelo implements Operations{
    public function __construct() {
        parent::__construct();
    }
    public function addRegistro($registro) {
        $temp = new Escuela();
        $temp =$registro;
        $sql = "INSERT INTO `escuela`"
                . "(`IdFacultad`,"
                . " `NombreEscuela`, "
                . "`EscuelaEstado`)"
                . " VALUES"
                . " (".$temp->getFacultad()->getId().","
                . "'".$temp->getNombre()."',"
                . "".$temp->getEstado().")";
        parent::getConn()->query($sql);
        return $sql;
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `escuela` SET `EscuelaEstado`=0 WHERE `IdEscuela`=".$id;
        parent::getConn()->query($sql);
        return $sql;
    }

    public function getListaJoin($idFacultad) {
        
        $sql = "SELECT * FROM `escuela` WHERE `EscuelaEstado`=1 and `IdFacultad`=".$idFacultad;
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `escuela` WHERE `IdEscuela`=" . $id;
        //echo $sql;
        $result = $this->getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        
        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
        $temp = new Escuela();
        $temp =$registro;
        $sql="UPDATE `escuela` SET "
                . "`IdFacultad`=".$temp->getFacultad()->getId().","
                . "`NombreEscuela`='".$temp->getNombre()."'"
                . " WHERE `IdEscuela`=".$temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }

    public function getLista() {
        $sql = "SELECT * FROM `escuela` WHERE `escuelaestado`=1 ";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }

}

