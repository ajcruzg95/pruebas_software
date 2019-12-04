<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Modelo.php';
include_once 'ModeloAlumno.php';
include_once 'ModeloDocente.php';
include_once 'ModeloDia.php';
include_once 'ModeloCurso.php';
include_once 'ModeloLugar.php';
include_once 'ModeloGrupo.php';
include_once 'ModeloHorario.php';
include_once 'ModeloAlumnoGrupo.php';
include_once 'ModeloAsistenciaDocente.php';
include_once 'ModeloAsistenciaAlumno.php';
/*
$buildAlumno=new BuilderAlumno("2", "casemiro", "villegas",20130873);
$buildAlumno->celular(941264670);
$buildAlumno->contrasenia("dada");
$buildAlumno->correo("ddezav");
$buildAlumno->estado(1);

$alumno = new Alumno($buildAlumno);

$modelAlumno = new ModeloAlumno();
$modelAlumno->addRegistro($alumno);
echo $alumno->getId()."<br>";
$modelAlumno->delRegistroPorId($alumno->getId());
echo $modelAlumno->getRegistroPorId("2")."<br>";
echo json_encode($modelAlumno->getListaPorCampo("alumno", "idalumno", "2"))."<br>";
echo json_encode($modelAlumno->getLista());

$buildDocente = new BuilderDocente("2", "cesar", "baluarte", 12312);
$buildDocente->celular(999999);
$buildDocente->contrasenia("dddddd");
$buildDocente->correo("cesasrb@gmail.com");
$buildDocente->dni("1");
$buildDocente->estado(1);
$docente = new Docente($buildDocente);

$modelDocente = new ModeloDocente();
$modelDocente->addRegistro($docente);
echo $docente->getId()."<br>";
$modelDocente->delRegistroPorId($docente->getId());
echo $modelDocente->getRegistroPorId("2")."<br>";
echo json_encode($modelDocente->getListaPorCampo("docente", "iddocente", "2"))."<br>";
echo json_encode($modelDocente->getLista());

$dia = new Dia("2", "MIERCOLES");
$modeloDia  = new ModeloDia();
$modeloDia->addRegistro($dia);
echo $dia->getId()."<br>";
$modeloDia->delRegistroPorId($docente->getId());
echo $modeloDia->getRegistroPorId("2")."<br>";
echo json_encode($modeloDia->getListaPorCampo("dia", "iddia", "2"))."<br>";
echo json_encode($modeloDia->getLista());

$curso= new Curso("2", "ADA", 5);
$modeloCurso = new ModeloCurso();
$modeloCurso->addRegistro($curso);
echo $curso->getId()."<br>";
$modeloCurso->delRegistroPorId($curso->getId());
echo $modeloCurso->getRegistroPorId("2")."<br>";
echo json_encode($modeloCurso->getListaPorCampo("curso", "idcurso", "2"))."<br>";
echo json_encode($modeloCurso->getLista());
*/
echo "HOLA ARMANDO CÓMO ESTÁS? =(";
$lugar = new Lugar("1", "AULA 303");
$modeloLugar = new ModeloLugar();
//$modeloLugar->addRegistro($lugar);
echo $lugar->getId()."<br>";
$modeloLugar->delRegistroPorId($lugar->getId());
//echo $modeloLugar->getRegistroPorId("2")."<br>";
//echo json_encode($modeloLugar->getListaPorCampo("lugar", "idlugar", "2"))."<br>";
echo json_encode($modeloLugar->getLista());
/*
$grupo = new Grupo("2", $curso, $docente, "B");
$modeloGrupo = new ModeloGrupo();
$modeloGrupo->addRegistro($grupo);
echo $lugar->getId()."<br>";
$modeloGrupo->delRegistroPorId($grupo->getId());
echo $modeloGrupo->getRegistroPorId("2")."<br>";
echo json_encode($modeloGrupo->getListaPorCampo("grupo", "idgrupo", "2"))."<br>";
echo json_encode($modeloGrupo->getLista());

$alumnogrupo= new AlumnoGrupo("1", $grupo, $alumno);
$modeloAlumnoGrupo = new ModeloAlumnoGrupo();
$modeloAlumnoGrupo->addRegistro($alumnogrupo);
echo $alumnogrupo->getId()."<br>";
$modeloAlumnoGrupo->delRegistroPorId($alumnogrupo->getId());
echo $modeloAlumnoGrupo->getRegistroPorId("1")."<br>";
echo json_encode($modeloAlumnoGrupo->getListaPorCampo("alumnogrupo", "idalumnogrupo", "2"))."<br>";
echo json_encode($modeloAlumnoGrupo->getLista());



$horaEntrada="2018-06-26 06:00:00";
$horaSalida="2018-06-26 11:00:00";
$horario = new Horario("2", $grupo, $lugar, $dia, $horaEntrada, $horaSalida);
$modeloHorario = new ModeloHorario();
$modeloHorario->addRegistro($horario);
echo $horario->getId()."<br>";
$modeloHorario->delRegistroPorId($horario->getId());
echo $modeloHorario->getRegistroPorId("2")."<br>";
echo json_encode($modeloHorario->getListaPorCampo("horario", "idhorario", "2"))."<br>";
echo json_encode($modeloHorario->getLista());

$fechaEntrada="2018-06-26 06:00:00";
$fechaSalida="2018-06-26 11:00:00";
$asistenciaDocente = new AsistenciaDocente("1", $grupo, $fechaEntrada, $fechaSalida);
$modeloAsistenciaDocente= new ModeloAsistenciaDocente();
$modeloAsistenciaDocente->addRegistro($asistenciaDocente);
echo $asistenciaDocente->getId()."<br>";
$modeloAsistenciaDocente->delRegistroPorId($asistenciaDocente->getId());
echo $modeloAsistenciaDocente->getRegistroPorId("1")."<br>";
echo json_encode($modeloAsistenciaDocente->getListaPorCampo("asistenciadocente", "idasistenciadocente", "1"))."<br>";
echo json_encode($modeloAsistenciaDocente->getLista());



$asistenciaAlumno = new AsistenciaAlumno("1", $asistenciaDocente, $alumno);
$modeloAsistenciaAlumno= new ModeloAsistenciaAlumno();
$modeloAsistenciaAlumno->addRegistro($asistenciaAlumno);
echo $asistenciaAlumno->getId()."<br>";
$modeloAsistenciaAlumno->delRegistroPorId($asistenciaAlumno->getId());

echo json_encode($modeloAsistenciaAlumno->getListaPorCampo("asistenciaalumno", "idasistenciaalumno", "1"))."<br>";
echo json_encode($modeloAsistenciaAlumno->getLista());

if($modeloAsistenciaAlumno->getRegistroPorId("7")==NULL){
    echo "funciono";
}*/