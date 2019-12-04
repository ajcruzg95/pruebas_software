<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModeloAlumno extends Modelo implements Operations{
   
    public function __construct() {
        parent::__construct();
    }
    
    public function addRegistro($registro) {
        $temp = new Alumno();
        $temp= $registro;
        
        $sql = "INSERT INTO `alumno`("
                . " `AlumnoNombre`, "
                . "`AlumnoApellido`,"
                . " `AlumnoCodigo`, "
                . "`AlumnoCorreo`,"
                . " `AlumnoCelular`, "
                . "`AlumnoContra`,"
                . " `IdEscuela1`) VALUES ('".$temp->getAlumnoNombre()."','"
                . $temp->getAlumnoApellido() ."',".$temp->getAlumnoCodigo().",'"
                . $temp->getAlumnoCorreo()."',".$temp->getAlumnoCelular().",'"
                . $temp->getAlumnoContrasenia()."',"
                . $temp->getEscuela().")";
        
        parent::getConn()->query($sql);
        return $sql;
    }
    public function actualizarDatosEmergencia($datos,$codigoAlumno){
        $sql= "UPDATE `alumno` SET "
                ." `AlumnoPersonaEmergeciaNombre` = '".$datos["pernom"]
                ."', `AlumnoPersonaEmergenciaCelular` = '".$datos["percel"]
                ."', `AlumnoCelular`= ".$datos["cel"]
                ." WHERE `alumno`.`AlumnoCodigo` = ".$codigoAlumno;
        
        parent::getConn()->query($sql);
        return $sql;
    
    }
    public function delRegistroPorId($id) {
        $sql = "UPDATE `alumno` SET `AlumnoEstado`=0 WHERE `IdAlumno`=".$id;
        echo $sql;
        parent::getConn()->query($sql);
        
    }

    public function getLista() {
        $sql = "SELECT * FROM `alumno` INNER JOIN  escuela ON alumno.IdEscuela1=escuela.IdEscuela WHERE `AlumnoEstado`=1 LIMIT 500";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }
    public function getListaPorEscuela($idEscuela){
        $sql = "SELECT IdAlumno,AlumnoCodigo,AlumnoNombre,AlumnoApellido,AlumnoCorreo,AlumnoCelular,AlumnoPersonaEmergeciaNombre,NombreEscuela,AlumnoPersonaEmergenciaCelular  FROM `alumno` INNER JOIN  escuela ON alumno.IdEscuela1=escuela.IdEscuela WHERE `AlumnoEstado`=1 and IdEscuela1=".$idEscuela;
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `alumno` WHERE `IdAlumno`=" . $id;
        //echo $sql;
        $result = $this->getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        
        return json_encode($outp[0]);
    }
  public function getIdByCUI($CUI) {
        $sql = "SELECT IdAlumno FROM `alumno` WHERE `alumnoCodigo`=" . $CUI;
        //echo $sql;
        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);

        
        return json_encode($outp[0]);
    }
     public function getIdByCUICompleto($CUI) {
        $sql = "SELECT IdAlumno,AlumnoNombre,AlumnoApellido FROM `alumno` WHERE `alumnoCodigo`=" . $CUI;
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
//        echo $sql;
        return json_encode($outp[0]);
    }
     public function getIdByCUICompletoValido($CUI) {
        $sql = "SELECT IdAlumno,AlumnoNombre,AlumnoApellido FROM `alumno` WHERE `alumnoCodigo`=" . $CUI." and `AlumnoEstado` = 1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
	//return $sql;
        return json_encode($outp[0]);

    }
    public function updRegistro($registro) {
        $temp = new Alumno();
        $temp =$registro;
        $sql="UPDATE `alumno` SET `IdEscuela1`=".$temp->getEscuela().","
                . "`AlumnoNombre`='".$temp->getAlumnoNombre()."',"
                . "`AlumnoApellido`='".$temp->getAlumnoApellido()."',"
                . "`AlumnoCodigo`=".$temp->getAlumnoCodigo().","
                . "`AlumnoCorreo`='".$temp->getAlumnoCorreo()."',"
                . "`AlumnoCelular`=".$temp->getAlumnoCelular().","
                . "`AlumnoContra`='".$temp->getAlumnoContrasenia()."'"
                . " WHERE `IdAlumno`=".$temp->getId();
        parent::getConn()->query($sql);
        return $sql;
    }

}
