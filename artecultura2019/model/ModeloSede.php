<?php
class ModeloSede extends Modelo implements Operations{
    public function __construct() {
        parent::__construct();
    }

    public function addRegistro($registro) {
        $temp = new Sede();
        $temp= $registro;
        
        $sql = "INSERT INTO"
                . " `sede`("
                . " `SedeNombre`,"
                . " `SedeEstado`)"
                . " VALUES ("
                . "'".$temp->getSedeNombre()."',"
                . "".$temp->getSedeEstado().")";        
        parent::getConn()->query($sql);
        return $sql;
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `sede` SET `SedeEstado`=0 WHERE `IdSede`=".$id;
        echo $sql;
        parent::getConn()->query($sql);
    }

    public function getLista() {
        $sql = "SELECT IdSede,SedeNombre,SedeActivo FROM `sede` WHERE `SedeEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `sede` WHERE `IdSede`=".$id;
        $result = parent::getConn()->query($sql);
        
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        
        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
        $temp = new Sede();
        $temp =$registro;
        $sql="UPDATE `sede` "
                . "SET `SedeNombre`='".$temp->getSedeNombre()."'"
                . "WHERE `IdSede`=".$temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }
    public function activar($registro) {
        $temp = new Sede();
        $temp =$registro;
        $sql="UPDATE `sede` "
                . "SET `SedeActivo`='1'"
                . "WHERE `IdSede`=".$temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }
    public function desactivar() {
        
        $sql="UPDATE `sede` "
                . "SET `SedeActivo`='0'"
                . "WHERE `SedeEstado`=1";
        parent::getConn()->query($sql);
        return $sql;
    }
}

