<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModeloAsistenciaAlumno extends Modelo implements Operations{
    
    public function addRegistro($registro) {
        $temp = new AsistenciaAlumno();
        $temp = $registro;
        $sql = "INSERT INTO `asistenciaalumno`("
                . " `IdAlumno`,"
                . " `IdAsistenciaDocente`,"
                . " `AsistenciaAlumnoEstado`) "
                . "VALUES (".$temp->getAlumno()->getId().","
                . "".$temp->getAsistenciaDocente()->getId().","
                . "".$temp->getEstado().")";
        parent::getConn()->query($sql);
    }

    public function delRegistroPorId($id) {
         $sql = "UPDATE `asistenciaalumno` SET `AsistenciaAlumnoEstado`=0 WHERE `IdAsistenciaAlumno`=".$id;
        parent::getConn()->query($sql);
    }
    
    public function crearAsistencias($idAlumno=0 ,$idAsistenciaDocente=0 ,$numeroAsistencia=0 ) {
        $temp = new AsistenciaAlumno();
        $temp = $registro;
        $ji = 1;
        $estado= 1 ; 
        while($ji <= $numeroAsistencia){
        $sql = "INSERT INTO `asistenciaalumno`("
                . " `IdAlumno`,"
                . " `IdAsistenciaDocente`,"
                ."  `AsistenciaAlumnoNumero`,"
                . " `AsistenciaAlumnoEstado`) "
                . "VALUES (".$idAlumno.","
                . " ".$idAsistenciaDocente.","
                . " ".$ji.","
              
                . " ".$estado.")";
        parent::getConn()->query($sql);
        
        }
    }

    
    public function getLista() {
         $sql = "SELECT * FROM `asistenciaalumno` WHERE `AsistenciaAlumnoEstado`=1";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }
   /* 
    public function getAsistenciaGrupo($id ) {
         $sql = "SELECT  alumno.AlumnoNombre , alumno.AlumnoApellido ,"
                 . " alumno.AlumnoCodigo,asistenciaalumno.AsistenciaAlumnoEstado,"
                 . "asistenciaalumno.AsistenciaAlumnoEstado as entrada,"
                . "asistenciaDocente.AistenciaDocenteFechaEntrada as fecha,"
                
                 . "docente.DocenteNombre  ,grupo.IdGrupo from"
                 . "(( ((asistenciaalumno INNER JOIN alumno on  asistenciaalumno.IdAlumno= alumno.IdAlumno)"
                 . "  INNER JOIN asistenciadocente on asistenciaalumno.IdAsistenciaDocente = asistenciadocente.IdAsistenciaDocente) "
                 . "INNER JOIN grupo  on asistenciadocente.IdGrupo=grupo.IdGrupo )"
                 . " INNER JOIN docente on grupo.IdDocente = docente.IdDocente)"
                 . "  where grupo.IdGrupo=1";
return $sql;
                 $result = parent::getConn()->query($sql);
        $outp = array();
       
       $fechas = array();
       $fechasSalida = array();
       $codigo = -1;
       $i = 0 ;
        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
           
            if ($codigo != $fila["AlumnoCodigo"]){
           $codigo = $fila ["AlumnoCodigo"];
           $Nombre = $fila ["AlumnoNombre"];
            $Apellido = $fila ["AlumnoApellido"];

           $fechas = array();}
           if ($i < 1 ){
               $fechasSalida[]=$fila["fecha"];
           }
           $fechas []= $fila ["entrada"];
            while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC) and $codigo ==$fila["AlumnoCodigo"]) {
                     $fechas []= $fila ["entrada"];
            if ($i < 1 ){
               $fechasSalida[]=$fila["fecha"];
           }
               } 
               $salida = array('nombre'=>$Nombre,'Apellido'=>$Apellido, 'fechasAsistidas' => $fechas );
               $outp[$codigo]=$salida;
           $fechas = array();
           $codigo = $fila ["AlumnoCodigo"];
           $Nombre = $fila ["AlumnoNombre"];
            $Apellido = $fila ["AlumnoApellido"];
            $fechas []= $fila ["entrada"];
        
           $i = $i+1;
            }
       $finalOut = array('fechas'=> $fechasSalida , 'Alumnos' =>$outp);
      // $finalOut['consulta']=$sql; 
       return json_encode($finalOut);
    }*/

    public function getRegistroPorId($id) {
        $sql = "SELECT * FROM `asistenciaalumno` WHERE `IdAsistenciaAlumno`=" . $id;

        $result = parent::getConn()->query($sql);

        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        if(count($outp)>0){
            return json_encode($outp[0]);
        }else{ 
            return NULL;
        }
    }

    public function updRegistro($registro) {
         $temp = new AlumnoGrupo();
        $temp = $registro;
        $sql="UPDATE `alumnogrupo` "
                . "SET `IdGrupo`=".$temp->getGrupo()->getId().","
                . "`IdAlumno`=".$temp->getAlumno()->getId().""
                . " WHERE `IdAlumnoGrupo`=".$temp->getId();
        
        parent::getConn()->query($sql);
        
    }
     public function updRegistroNumero( $idAlumno   ,$Idgrupo , $numero , $valor) {
         $temp = new AlumnoGrupo();
      
        $sql="UPDATE `asistenciaalumno` "
                . "SET `AsistenciaAlumnoEstado`=".$valor." "
                . " WHERE `IdAlumno`=".$idAlumno." and "
                . "idGrupo = ".$Idgrupo." and "
                ." AsistenciaAlumnoNumero = ". $numero. "";
        
        parent::getConn()->query($sql);
        return $sql;
    }

}
