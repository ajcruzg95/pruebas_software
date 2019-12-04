<?php

class ModeloMatricula extends Matricula implements Operations {

    public function __construct() {
        parent::__construct();
    }

    public function addRegistro($temp) {
        $registro = new Matricula();
        $registro = $temp;

        $sql = "INSERT INTO `matriculaCab`"
                . " ( `CursoNombre`,"
                . "  `CursoCreditos`,CursoEstado) "
                . "VALUES ('" 
                . $registro->getCursoNombre() . "', '" 
                . $registro->getCursoCreditos() . "',"
                .$registro->getCursoEstado().");";
        $result = parent::getConn()->query($sql);
        
    }

    public function getLista() {

        $sql = "SELECT * FROM curso where `CursoEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM curso where IdCurso=" . $id;

        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($outp[0]);
    }

    public function delRegistroPorId($id) {
        $sql = "UPDATE `curso` SET `CursoEstado`=0 WHERE `IdCurso`=" . $id;
        parent::getConn()->query($sql);
    }

    public function updRegistro($temp) {
        $registro = new Curso();
        $registro = $temp;
        $sql = "UPDATE `curso` SET `CursoNombre`='" . $registro->getCursoNombre() . "'"
                . ",`CursoCreditos`=" . $registro->getCursoCreditos() . " WHERE `IdCurso`=" . $registro->getId();
        $result = parent::getConn()->query($sql);
    }


}
