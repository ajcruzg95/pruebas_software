<?php

class ModeloPeriodo extends Modelo implements Operations {

    public function __construct() {
        parent::__construct();
    }

    public function addRegistro($registro) {
        $temp = new Periodo();
        $temp = $registro;

        $sql = "INSERT INTO `periodo`"
                . "(`IdSede`,"
                . " `PeriodoAnio`,"
                . " `PeriodoNumero`, "
                . "`PeriodoActivo`,"
                . " `PeriodoEstado`)"
                . " VALUES (" . $temp->getSede() . ","
                . "" . $temp->getAnio() . ","
                . "" . $temp->getNumero() . ","
                . "" . $temp->getActivo() . ","
                . "" . $temp->getEstado() . ")";
        parent::getConn()->query($sql);
        return $sql;
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `periodo` SET `PeriodoEstado`=0 WHERE `IdPeriodo`=" . $id;
        echo $sql;
        parent::getConn()->query($sql);
    }

    public function getListaJoin($idSede) {

        $sql = "SELECT * FROM `periodo` WHERE `PeriodoEstado`=1 and `IdSede`=" . $idSede;
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp);
    }

    public function getLista() {
        $sql = "SELECT * FROM `periodo` WHERE `PeriodoEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `periodo` WHERE `IdPeriodo`=" . $id;
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
        $temp = new Periodo();
        $temp = $registro;
        $sql = "UPDATE `periodo` "
                . "SET `IdSede`=" . $temp->getSede() . ","
                . "`PeriodoAnio`=" . $temp->getAnio() . ","
                . "`PeriodoNumero`=" . $temp->getNumero() . ","
                . "`PeriodoActivo`=" . $temp->getActivo() . ","
                . "`PeriodoEstado`=" . $temp->getEstado() . "
                 WHERE `IdPeriodo`=" . $temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }

    public function activar($registro) {
        $temp = new Periodo();
        $temp = $registro;
        $sql = "UPDATE `periodo` "
                . "SET `PeriodoActivo`='1'"
                . "WHERE `IdPeriodo`=" . $temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }

    public function desactivar() {

        $sql = "UPDATE `periodo` "
                . "SET `PeriodoActivo`='0'"
                . "WHERE `PeriodoEstado`=1";
        parent::getConn()->query($sql);
        return $sql;
    }
    public function getIdActivo() {
        $sql = "SELECT * FROM `periodo` WHERE `PeriodoActivo`='1' and PeriodoEstado=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp[0]);
    }


}
