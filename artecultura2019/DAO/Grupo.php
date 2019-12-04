<?php

class Grupo {

    private $idGrupo;
    private $curso;
    private $docente;
    private $grupoNombre;
    private $grupoEstado;
    private $listaHorario;
    private $listaAsistDocente;
    
    private $grupoCapacidad;
    private $grupoCodigo;
    
    private $periodo;

    function __construct($id = "", Curso $curso = NULL, Docente $docente = NULL, $nombre = "",$capacidad="",$codigo="", $estado = "1") {
        $this->idGrupo = $id;
        $this->listaHorario = array();
        $this->listaAsistDocente = array();

        $this->curso = new Curso();
        $this->curso = $curso;

        $this->docente = new Docente();
        $this->docente = $docente;
        $this->grupoNombre = $nombre;
        
        $this->grupoCapacidad=$capacidad;
        $this->grupoCodigo=$codigo;
        
        $this->grupoEstado = $estado;
        
        
    }

    public function getId() {
        return $this->idGrupo;
    }

    public function getListaHorario() {
        //$modeloHorario = new ModeloHorario();
        return $this->listaHorario;
    }

    public function getListaAsistenciaDocente() {
        return $this->listaAsistDocente;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getDocente() {
        return $this->docente;
    }

    public function getGrupoNombre() {
        return $this->grupoNombre;
    }

    public function getGrupoEstado() {
        return $this->grupoEstado;
    }
    public function getGrupoCapacidad() {
        return $this->grupoCapacidad;
    }
    public function getGrupoCodigo() {
        return $this->grupoCodigo;
    }
    public function setPeriodo($periodo) {
        $this->periodo=$periodo;
    }
    public function getPeriodo() {
        return $this->periodo;
    }
    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setDocente($docente) {
        $this->docente = $docente;
    }

    function setGrupoNombre($grupoNombre) {
        $this->grupoNombre = $grupoNombre;
    }

    function setGrupoEstado($grupoEstado) {
        $this->grupoEstado = $grupoEstado;
    }

    function setGrupoCapacidad($grupoCapacidad) {
        $this->grupoCapacidad = $grupoCapacidad;
    }

    function setGrupoCodigo($grupoCodigo) {
        $this->grupoCodigo = $grupoCodigo;
    }


}
/*
$curso = new Curso("1", "EDAT", "5", "1");
$builderDocente = new BuilderDocente("2", "dav", "perez", "123");
$docente  = new Docente($builderDocente);

$lugar = new Lugar("12", "aula 302");
$dia = new Dia("1", "lunes");
$listaHorario = array();
array_push($listaHorario, new Horario("1", $lugar, $dia, "9 en punto", "10 en punto"));
array_push($listaHorario, new Horario("1", $lugar, $dia, "10 en punto", "12 en punto"));

$listaAlumnos = array();
array_push($listaAlumnos, new AsistenciaAlumno("11", new Alumno(new BuilderAlumno("112", "pepito", "deza")), "1"));
array_push($listaAlumnos, new AsistenciaAlumno("12", new Alumno(new BuilderAlumno("112", "juan", "mamani")), "1"));




$listaDocente = array();
array_push($listaDocente, new AsistenciaDocente("12", $listaAlumnos, "A LAS 18", "A LAS 20", "1"));
array_push($listaDocente, new AsistenciaDocente("13", $listaAlumnos, "A LAS 20", "A LAS 22", "1"));



$grupo = new Grupo("123", $listaHorario, $listaDocente, $curso, $docente, "A", "1");
echo $grupo->getDocente()->getDocenteNombre();
$varHorario = new Horario();
$varHorario=$grupo->getListaHorario()[0];
echo $varHorario->getHoraEntrada()." ".$varHorario->getHoraSalida();
$varListaDocente = new AsistenciaDocente();
$varListaDocente = $grupo->getListaAsistenciaDocente()[1];
echo $varListaDocente->getFechaEntrada()." ".$varListaDocente->getFechaSalida();
echo "<br>";
$value = new AsistenciaAlumno();
foreach ($varListaDocente->getListaAsistenciaAlumno() as $value) {
    $alumno = new Alumno(new BuilderAlumno());
    $alumno = $value->getAlumno();
    echo $alumno->getAlumnoNombre()." ".$alumno->getAlumnoApellido()."<br>";
}

 */
