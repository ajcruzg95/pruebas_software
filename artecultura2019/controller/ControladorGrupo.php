<?php

require '../model/Modelo.php';
require '../model/ModeloGrupo.php';

require '../model/ModeloCurso.php';

require '../model/ModeloDocente.php';
require "OperationsController.php";

class ControllerGrupo implements OperationsController {

    public $model;
    public $elimino;

    public function __construct() {
        $this->model = new ModeloGrupo();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['IdGrupo']) && isset($_POST['IdCurso'])
                && isset($_POST['IdDocente']) && isset($_POST['GrupoNombre'])
                 && isset($_POST['GrupoCodigo']) && isset($_POST['GrupoCapacidad']);

        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = $_POST['IdGrupo'];

            if (!is_numeric($id)) {
                $this->agregar();
            } else {
                $this->modificar();
            }
        } elseif ($estaFiltrando && !$estaFormularioLleno && $estaModificandoOEliminando) {
            $id = $_POST['id'];
            if ($_POST['modo'] == 1) {
                $this->conseguir();
            }
            if ($_POST['modo'] == 2) {
                $this->eliminar();
            }
            if ($_POST['modo'] == 3) {
                
                $idPeriodo = $_SESSION['IdPeriodo'] ;
                echo $this->model->getListaCodigoGrupo($id,$idPeriodo);
            }
            if ($_POST['modo'] == 4) {
                $idPeriodo = $_SESSION['IdPeriodo'] ;
                echo $this->model->getMatriculadosCodigoGrupo($id,$idPeriodo);
            }
            if ($_POST['modo'] == 5) {
                
                $this->cerrarGrupo($id);
            }
        }
    }

    public function agregar() {
        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];
        
        $capacidad = $_POST['GrupoCapacidad'];
        $codigo=$_POST['GrupoCodigo'];
        $idPeriodo = $_SESSION['IdPeriodo'] ;
        
        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre,$capacidad,$codigo);
        $grupo->setPeriodo($idPeriodo);
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
        echo $grupo;
    }

    public function eliminar() {
        $id = ($_POST['id']);
        echo $this->model->delRegistroPorId($id);
        $grupos = $this->model->getLista();
        echo $grupos;
    }

    public function inicio() {
        $modeloCurso = new ModeloCurso();
        $modeloDocente = new ModeloDocente();

        $cursos = $modeloCurso->getLista();
        $docentes = $modeloDocente->getLista();
        
        $idPeriodo=$_SESSION['IdPeriodo'];
        
        $grupos = $this->model->getListaJoin($idPeriodo);
        
        include '../viewPhp/gestionGrupo.php';
    }

    public function modificar() {
        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];
        
        $capacidad = $_POST['GrupoCapacidad'];
        $codigo=$_POST['GrupoCodigo'];
        
        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre,$capacidad,$codigo);
        $this->model->updRegistro($grupo);
        $this->inicio();
    }
     public function cerrarGrupo($idGrupo) {
        
        $this->model->cambiarEstado($idGrupo);
        $this->model->cerrarGrupo($idGrupo);
    }
   
}
session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerGrupo();
	    $controller->invoke();
	}	
}


