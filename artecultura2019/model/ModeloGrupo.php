<?php
require 'Modelo.php';
require 'ModeloAlumnoGrupo.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (class_exists('ModeloGrupo') != true) {

    class ModeloGrupo extends Modelo implements Operations {

        public function __construct() {
            parent::__construct();
        }

        public function addRegistro($registro) {
            $temp = new Grupo();
            $temp = $registro;
            $sql = "INSERT INTO `grupo`"
                    . "(`IdCurso`,"
                    . " `IdDocente`,"
                    . " `IdPeriodo`,"
                    . " `GrupoNombre`,"
                    . " `GrupoCodigo`,"
                    . " `GrupoCapacidad`,"
                    . "`GrupoEstado`)"
                    . " VALUES "
                    . "(" . $temp->getCurso()->getId() . ","
                    . "" . $temp->getDocente()->getId() . ","
                    . "" . $temp->getPeriodo() . ","
                    . "'" . $temp->getGrupoNombre() . "',"
                    . "'" . $temp->getGrupoCodigo() . "',"
                    . "'" . $temp->getGrupoCapacidad() . "',"
                    . "1)";
            parent::getConn()->query($sql);
            return $sql;
        }

        public function delRegistroPorId($id) {
            $sql = "UPDATE `grupo` SET `GrupoEstado`=0 WHERE `IdGrupo`=" . $id;
            parent::getConn()->query($sql);
        }

        public function getLista() {
            $sql = "SELECT * FROM `grupo` WHERE `GrupoEstado`=1";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            return json_encode($outp);
        }

        public function getRegistroPorId($id) {
            $sql = "SELECT * FROM `grupo` WHERE `IdGrupo`=" . $id;

            $result = parent::getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);


            return json_encode($outp[0]);
        }

        public function getRegistroPorIdDocente($id) {
            $sql = "SELECT * FROM `grupo` WHERE `IdDocente`=" . $id;

            $result = parent::getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            if (count($outp) > 0) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
        }
        public function cambiarAlumnos($id){
            
        }
        public function updRegistro($registro) {
            $temp = new Grupo();
            $temp = $registro;
            $sql = "UPDATE `grupo` "
                    . "SET `IdCurso`=" . $temp->getCurso()->getId() . ","
                    . "`IdDocente`=" . $temp->getDocente()->getId() . ","
                    . "`GrupoNombre`='" . $temp->getGrupoNombre() . "',"
                    . "`GrupoCodigo`='" . $temp->getGrupoCodigo() . "',"
                    . "`GrupoCapacidad`=" . $temp->getGrupoCapacidad() . " "
                    . " WHERE `IdGrupo`=" . $temp->getId();

            parent::getConn()->query($sql);
        }

        public function getListaId($id) {
            $sql = "SELECT grupo.IdGrupo,"
                    . " curso.CursoNombre , "
                    . "grupo.GrupoNombre "
                    . "FROM grupo INNER JOIN curso ON grupo.IdCurso= curso.IdCurso"
                    . " where grupo.GrupoEstado=1 and grupo.IdGrupo=" . $id;
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            if (count($outp) > 0) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
        }
        public function getListaGrupoPorIdCurso($idCurso,$idPeriodo){
            $sql="SELECT grupo.IdGrupo,grupo.GrupoNombre FROM grupo where grupo.IdCurso=".$idCurso." and
            grupo.IdPeriodo=".$idPeriodo;
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            //return $sql;
            return json_encode($outp);

        }
          public function getListaGrupoPorIdCursoConcupos($idCurso,$idPeriodo){
            $sql="SELECT grupo.IdGrupo ,concat(grupo.GrupoNombre,if(SUM(if(alumnogrupo.AlumnoGrupoEstado=5,1,0))< (grupo.GrupoCapacidad-SUM(if(alumnogrupo.AlumnoGrupoEstado=1,1,0))),' ',' (AGOTADO)')) as GrupoNombre , if(SUM(if(alumnogrupo.AlumnoGrupoEstado=5,1,0))< (grupo.GrupoCapacidad-SUM(if(alumnogrupo.AlumnoGrupoEstado=1,1,0))),'1','0') as selecionable from grupo  LEFT join alumnogrupo on grupo.IdGrupo=alumnogrupo.IdGrupo where grupo.IdPeriodo=".$idPeriodo." and grupo.IdCurso=".$idCurso." and grupo.GrupoEstado=1 GROUP by grupo.IdGrupo ORDER BY grupo.GrupoNombre";  
              
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            //return $sql;  
            return json_encode($outp);

        }
        public function getListaCodigoGrupo($codigoGrupo,$idPeriodo) {
            $sql = "SELECT grupo.IdGrupo,"
                    . " curso.CursoNombre , "
                    . "grupo.GrupoNombre "
                    . "FROM grupo INNER JOIN curso ON grupo.IdCurso= curso.IdCurso"
                    . " where grupo.GrupoEstado=1 and grupo.GrupoCodigo='" . $codigoGrupo . "' and
                    grupo.IdPeriodo=".$idPeriodo ;
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            //return $sql;
            if (count($outp) > 0) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
        }

        public function getMatriculadosCodigoGrupo($codigoGrupo,$idPeriodo) {
            $sql = "SELECT grupo.IdGrupo,"
                    . " curso.CursoNombre , "
                    . "grupo.GrupoNombre "
                    . "FROM grupo INNER JOIN curso ON grupo.IdCurso= curso.IdCurso"
                    . " where grupo.GrupoEstado=1 and grupo.GrupoCodigo='" . $codigoGrupo . "' and
                    grupo.IdPeriodo=".$idPeriodo ;
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            //return $sql;
            if (count($outp) > 0) {
                $id = $outp[0]['IdGrupo'];
            } else {
                $id=null;
            }
            
            $sql = "SELECT DISTINCT grupo.IdGrupo ,grupo.GrupoCapacidad,
            (SELECT COUNT(*) FROM alumnogrupo WHERE alumnogrupo.IdGrupo = grupo.IdGrupo and AlumnoGrupoEstado=1) AS Matriculados
            FROM grupo where IdGrupo =" . $id . " and grupo.GrupoEstado=1";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            if (count($outp) > 0) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
            
        }

        public function getListaJoin($idPeriodo) {
            $sql = "SELECT DISTINCT grupo.IdGrupo,docente.IdDocente ,
             docente.DocenteNombre , docente.DocenteApellido ,
             curso.IdCurso, curso.CursoNombre ,
               grupo.GrupoNombre ,grupo.GrupoCodigo ,
               grupo.GrupoCapacidad,(SELECT COUNT(IdAlumnoGrupo) FROM alumnogrupo WHERE alumnogrupo.IdGrupo = grupo.IdGrupo and (alumnogrupo.AlumnoGrupoEstado=1)) AS Matriculados,
               grupo.GrupoEstado FROM grupo INNER JOIN docente ON grupo.IdDocente= docente.IdDocente INNER JOIN curso ON grupo.IdCurso= curso.IdCurso
                where grupo.IdPeriodo=" . $idPeriodo . " and (grupo.GrupoEstado=1 or grupo.GrupoEstado=2) GROUP BY grupo.IdGrupo";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
	//return $sql;
            return json_encode($outp);
            
        }
        //si el estado de la matricula es 1 cambia a 3 o 4 dependiendo del numero de asistencias
        //si el estado es 3 o 4(abandono,aprobado) cambia a 1
        public function  cerrarGrupo($idGrupo){
             $sql = "SELECT IdAlumno , sum(AsistenciaAlumnoEstado) as asistencias
               FROM `asistenciaalumno` where idgrupo=".$idGrupo." GROUP by IdAlumno
                ";
                $result = parent::getConn()->query($sql);
            
                while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            
                    $idAlumno = $fila ["IdAlumno"];
                    $asis= $fila ["asistencias"];
                    $valor = 4;
                    if ($asis< 12){
                        $valor =3;
                    }
                    $sql = "UPDATE `alumnogrupo` 
                    SET `AlumnoGrupoEstado`=IF(`AlumnoGrupoEstado`= 1,".$valor.",IF(`AlumnoGrupoEstado`= 3 OR `AlumnoGrupoEstado`= 4,1,`AlumnoGrupoEstado`)) 
                    WHERE `IdGrupo`=".$idGrupo." and `IdAlumno`=".$idAlumno;
                 
                    parent::getConn()->query($sql);
                 
                }

        }
        //cuando el estado es 1 -> las matriculas estan activas
        //cuando el estado es 2 -> las matriculas estan en aprobados o abandonos
        public function cambiarEstado($idGrupo){
                $sql="UPDATE  grupo
                SET     GrupoEstado = IF(GrupoEstado = 1,2,IF(GrupoEstado = 2,1,0))
                WHERE   IdGrupo =".$idGrupo;
                parent::getConn()->query($sql);
        }
        public function  cerrarGrupoTodos(){
            $sql = "SELECT idGrupo FROM `grupo` WHERE `GrupoEstado`=1";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
             while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            
                $codigo = $fila ["idGrupo"];
                $this->cerrarGrupo($codigo);
                }

        }
    }

}
