<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ModeloHorario extends Modelo implements Operations{
    
    public function __construct() {
        parent::__construct();
    }
    public function addRegistro($registro) {
        $temp = new Horario();
        $temp = $registro;
        $sql = "INSERT INTO `horario`"
                . "(`IdGrupo`,"
                . " `IdLugar`, "
                . "`IdDia`,"
                . " `HorarioEntrada`, "
                . "`HorarioSalida`,"
                . "`HorarioEstado`)"
                . " VALUES"
                . " (".$temp->getGrupo()->getId().","
                . "".$temp->getLugar()->getId().","
                . "".$temp->getDia()->getId().","
                . "'".$temp->getHoraEntrada()."',"
                . "'".$temp->getHoraSalida()."',"
                . "".$temp->getHorarioEstado().")";
        parent::getConn()->query($sql);
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `horario` SET `HorarioEstado`=0 WHERE `IdHorario`=".$id;
        parent::getConn()->query($sql);
        return $sql;
    }

    public function getLista() {
        $sql = "SELECT * FROM `horario` WHERE `IdHorario`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `horario` WHERE `IdHorario`=" . $id;
        
        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp[0]);
    }

    public function updRegistro($registro) {
        $temp = new Horario();
        $temp = $registro;
        $sql="UPDATE `horario` SET "
                . "`IdGrupo`=".$temp->getGrupo()->getId().","
                . "`IdLugar`=".$temp->getLugar()->getId().","
                . "`IdDia`=".$temp->getDia()->getId().","
                . "`HorarioEntrada`='".$temp->getHoraEntrada()."',"
                . "`HorarioSalida`='".$temp->getHoraSalida()."'".
                " WHERE `IdHorario`=".$temp->getId();
        
        parent::getConn()->query($sql);
        return $sql;
    }
    public function getListaJoin($idgrupo) {
        $sql = "SELECT horario.IdHorario,  dia.DiaDescripcion, lugar.LugarNombre,
            DATE_FORMAT(horario.HorarioEntrada,'%H:%i') as HorarioEntrada ,
            DATE_FORMAT(horario.HorarioSalida,'%H:%i') as HorarioSalida
               FROM horario INNER JOIN dia ON horario.IdDia= dia.IdDia 
                 INNER JOIN lugar ON horario.IdLugar= lugar.IdLugar where 
                 horario.HorarioEstado=1 and `IdGrupo`=" . $idgrupo." ORDER BY dia.IdDia ASC";
        
        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }
}
