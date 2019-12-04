<?php

class ModeloLugar extends Modelo {
    public function __construct() {
        parent::__construct();
    }

    public function addRegistro($registro) {
         $temp = new Lugar();
        $temp = $registro;
        $sql = "INSERT INTO `lugar`( "
                . "`LugarNombre`,"
                . " `LugarEstado`)"
                . " VALUES"
                . " ('".$temp->getLugarNombre()."',"
                . "".$temp->getLugarEstado().")";
        parent::getConn()->query($sql);
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `lugar` SET `LugarEstado`=0 WHERE `IdLugar`=".$id;        
        parent::getConn()->query($sql);
        return $sql;
    }

    public function getLista() {
         $sql = "SELECT * FROM `lugar` WHERE `LugarEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `lugar` WHERE `IdLugar`=" . $id;

        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
        $temp = new Lugar();
        $temp = $registro;
        $sql="UPDATE `lugar`"
                . " SET `LugarNombre`='".$temp->getLugarNombre()."'"
                . " WHERE `IdLugar`=".$temp->getId();
        
        parent::getConn()->query($sql);
    }


}
