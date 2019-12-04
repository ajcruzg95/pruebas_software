<?php

require '../model/Modelo.php';
require '../model/ModeloGrupo.php';
require '../model/ModeloAlumnoGrupo.php';
require '../model/ModeloAsistenciaAlumno.php';

require '../model/ModeloCurso.php';

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
        $grupos = $modelo->getListaJoin(1);
        //echo $grupos;
        //include '../viewPhp/gestionAsistencia.php';
    }

    public function invoke() {
        
        $ajax = isset($_POST['modo']);

        if (!$ajax) {
            $modelo = new ModeloAsistenciaAlumno();
            $grupos = $modelo->getAsistenciaGrupo(1);
                        echo "ddddd";

            echo $grupos;
 
            echo "asdasd";
  
            $this->inicio();
            
        } else{
            $id = $_POST['idGrupo'];
            $modelo = new ModeloAsistenciaAlumno();
            $grupos = $modelo->getListaGrupo($id);
                        echo "ddddd";

            echo $grupos;
            //echo "00";
        }
        
    }
    public function listarAlumnos($idGrupo){

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

