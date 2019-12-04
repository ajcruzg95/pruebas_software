<?php
require '../model/Modelo.php';
require '../model/ModeloPeriodo.php';
require '../model/ModeloAlumnoGrupo.php';
require 'OperationsController.php';

class ControllerAlumnoPrematricula implements OperationsController {
    public $model;
    
    public function __construct() {
        $this->model = new ModeloAlumnoGrupo();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['idAlumno']) && isset($_POST['idCurso']);
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);
        
        
        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['idAlumnoGrupo']);            
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
               echo $this->getMatriculasPorCodAlumno($id,$_SESSION['IdPeriodo']);
                
            }
            if ($_POST['modo'] == 4) {
               $this->validarMatricula($id);
             }
 
        }
    }
    public function conseguir() {
        $id = $_POST['id'];
        echo $this->model->getRegistroPorId($id);
    }

    public function agregar() {
        $curso = $_POST['idCurso'];

        $modeloCurso = $this->model->getListaPorCampo("grupo","GrupoCodigo","\"".$curso."\"");
        //echo json_encode($modeloCurso);
        $idGrupo= $modeloCurso[0]['IdGrupo'];
        $grupo = new Grupo($idGrupo);
        
        
        $alumno = $_POST['idAlumno'];
        $modeloAlumno = $this->model->getListaPorCampo("alumno","AlumnoCodigo","\"".$alumno."\"");
        $alumnoo = $modeloAlumno[0]['IdAlumno'];
        $alumno = new Alumno(new BuilderAlumno($alumnoo));

        $alumnoGrupo = new AlumnoGrupo("",$grupo, $alumno);
        
        
        $this->model->addRegistro($alumnoGrupo);
        $this->inicio();
    }

    public function eliminar() {
        $id = $_POST['id'];
        $this->model->updEstRegPorId($id,0);
        
    }

    public function inicio() {
      
        $modeloGrupo = new ModeloAlumnoGrupo();
        
        $modelPeriodo = new ModeloPeriodo();
        $periodoActivo = $modelPeriodo->getIdActivo();
        $jsonPeriodoActivo = json_decode($periodoActivo, true);
        $idPeriodo = $jsonPeriodoActivo['IdPeriodo'];
        
        
        //activos estado 1
        $info1 = $modeloGrupo->getListaJoinGrupoAlumnoAll($idPeriodo,"5");
        $_SESSION['info']=$info1;
        //include '../viewPhp/gestionAlumnoPrematricula.php';
        header("Location: ../viewPhp/gestionAlumnoPrematricula.php",true,303); 
    }

    public function modificar() {
        $curso = new Grupo($_POST['idCurso']);
        $alumno = new Alumno(new BuilderAlumno($_POST['idAlumno']));
        
        $alumnoGrupo = new AlumnoGrupo("",$curso, $alumno);
        $this->model->updRegistro($alumnoGrupo);
        $this->inicio();
    }
    public function getMatriculasPorCodAlumno($codigoAlumno,$idPeriodo) {
        
        $matriculas = $this->model->getMatriculasCodAlumno($codigoAlumno,$idPeriodo);        
        $array=json_decode($matriculas, true);
        return $array[0]['matriculas'];
        
    }
    public function validarMatricula($idAlumnoGrupo) {
        echo $this->model->updEstRegPorId($idAlumnoGrupo,1);
        
    }
}


session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerAlumnoPrematricula();
	    $controller->invoke();
	}	
}
