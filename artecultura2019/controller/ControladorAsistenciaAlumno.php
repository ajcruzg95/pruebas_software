<?php

require '../model/Modelo.php';
require '../model/ModeloGrupo.php';
require '../model/ModeloAlumnoGrupo.php';

require '../model/ModeloCurso.php';
require '../model/ModeloAlumno.php';
require '../model/ModeloAsistenciaAlumno.php';

require '../model/ModeloDocente.php';
require "OperationsController.php";

class ControllerGrupo implements OperationsController {

    public $model;
    public $elimino;

    public function __construct() {
        $this->model = new ModeloGrupo();
    }

    public function inicio() {
        $modelo = new ModeloAlumnoGrupo();
        $idPeriodo=$_SESSION['IdPeriodo'];
        if(isset($_SESSION['IdDocente'])){
            $grupos = $modelo->getListaJoin($_SESSION['IdDocente'],$idPeriodo);
        }else{
            $modeloGrupo= new ModeloGrupo();
            $grupos =$modeloGrupo->getListaJoin($idPeriodo);
        }
        include '../viewPhp/gestionAsistenciaAlumno.php';
    }

    public function invoke() {

        $ajax = isset($_POST['modo']);

        if (!$ajax) {
            $this->inicio();
        } elseif ($_POST['modo'] == 1) {
            $id = $_POST['idAlumno'];
            $modelo = new ModeloAlumnoGrupo();
            $grupos = $modelo->getAsistenciaAlumno($id);
            echo $grupos;
        } elseif ($_POST['modo'] == 2) {
            # code...

            $ra = $_POST['registroAsistencias'];
            $ras2 = json_decode($ra);
            $temp = "";
            $ras = $ras2[0];
            $grupo = $ras2[0]->grupo;
            $alumnos = $ras->registro;
            foreach ($alumnos as &$valor) {
                $n = $valor->e;
                $i = 1;
                foreach ($n as $np) {
                    $this->guardar($valor->CUI, $np, $grupo, $i);
                    $i = $i + 1;
                }
            }
            //echo json_encode($ra);
            echo $temp . '';
        }
    }

    public function guardar($CUI = 0, $Asistio, $grupo, $n) {
        $modeloAlumno = new ModeloAlumno();
        $modeloAsistencia = new ModeloAsistenciaAlumno();
        $id = $modeloAlumno->getIdByCUI($CUI);
        $id2 = json_decode($id, true);
        $alu = new Alumno(new BuilderAlumno($id2["IdAlumno"]));
        echo "aqui";
        echo $modeloAsistencia->updRegistroNumero($alu->getId(), $grupo, $n, $Asistio);
    }

    public function listarAlumnos($idGrupo) {
        
    }

    public function agregar() {


        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];

        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre);
        $this->model->addRegistro($grupo);
        $this->inicio();
    }

    public function conseguir() {
        $modeloCurso = new ModeloCurso();
        $modeloDocente = new ModeloDocente();

        $cursos = $modeloCurso->getLista();
        $docentes = $modeloDocente->getLista();

        $id = $_POST['id'];
        $grupo = $this->model->getRegistroPorId($id);
        $grupos = $this->model->getListaJoin();

        echo $grupo;
    }

    public function eliminar() {
        $id = ($_POST['id']);
        echo $this->model->delRegistroPorId($id);
        $grupos = $this->model->getLista();
        echo $grupos;
    }

    public function modificar() {


        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];

        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre);
        $this->model->updRegistro($grupo);
        $grupos = $this->model->getListaJoin();

        include '../viewPhp/gestionGrupo.php';
    }

}
session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerGrupo();
	    $controller->invoke();
	}	
}
