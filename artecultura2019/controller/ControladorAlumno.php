<?php
require '../model/Modelo.php';
require '../model/ModeloAlumno.php';
require '../model/ModeloCurso.php';
require "OperationsController.php";

class ControllerAlumno implements OperationsController {

    public $model;
    
    public function __construct() {
        $this->model = new ModeloAlumno();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['AlumnoNombre']) &&
                isset($_POST['AlumnoApellido']) && isset($_POST['AlumnoCodigo']) &&
                isset($_POST['IdEscuela1'])&&
                isset($_POST['AlumnoCorreo']) && isset($_POST['AlumnoCelular']);
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);
        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = $_POST['IdAlumno'];
            if (!is_numeric($id)  ) {
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
                $idee =$_POST['id'];
		echo $this->model->getIdByCUICompletoValido($idee);
            }
            if ($_POST['modo'] == 4) {
                $idEscuela =$_POST['id'];
                echo $this->model->getAlumnosPorEscuela($idEscuela);
            }

        }
    }

    public function agregar() {
        $nombre = $_POST['AlumnoNombre'];
        $apellido = $_POST['AlumnoApellido'];
        $cui = $_POST['AlumnoCodigo'];
        $idescuela1 = $_POST['IdEscuela1'];
        $correo = $_POST['AlumnoCorreo'];
        $celular = $_POST['AlumnoCelular'];
        
        $builder = new BuilderAlumno();

        $buildAlumno=new BuilderAlumno("", $idescuela1,$nombre, $apellido,$cui);
        $buildAlumno->celular($celular);
        $buildAlumno->contrasenia("");
        $buildAlumno->correo($correo);

        $alumno = new Alumno($buildAlumno);
        $this->model->addRegistro($alumno);
        
        $this->inicio();
    }

    public function conseguir() {
        $id = $_POST['id'];
        echo $this->model->getRegistroPorId($id);
    }
    
    public function eliminar() { 
        $id = ($_POST['id']);
        $this->model->delRegistroPorId($id);
    }

    public function inicio() {
        $ModeloAlumno = new ModeloAlumno();
        $escuelas = json_encode($ModeloAlumno->getListaPorCampo("escuela", "escuelaestado", "1"));
      
        if(isset($_POST['IdEscuela'])){
            $idEscuela=$_POST['IdEscuela'];
            $alumnos = $ModeloAlumno->getListaPorEscuela($idEscuela);
            include '../viewPhp/gestionAlumno.php';
        }else{
            $idEscuela=-1;
            $alumnos = $ModeloAlumno->getListaPorEscuela($idEscuela);
            include '../viewPhp/gestionAlumno.php';    
        }
        
    }

    public function modificar() {
        $id = $_POST['IdAlumno'];
        $nombre = $_POST['AlumnoNombre'];
        $apellido = $_POST['AlumnoApellido'];
        $cui = $_POST['AlumnoCodigo'];
        $idescuela1 = $_POST['IdEscuela1'];
        $correo = $_POST['AlumnoCorreo'];
        $celular = $_POST['AlumnoCelular'];
        
        $builder = new BuilderAlumno();
        $buildAlumno=new BuilderAlumno($id,$idescuela1, $nombre, $apellido,$cui);
        $buildAlumno->celular($celular);
        $buildAlumno->contrasenia("");
        $buildAlumno->correo($correo);
        

        $alumno = new Alumno($buildAlumno);
        $this->model->updRegistro($alumno);
        $this->inicio();
    }
    
}
session_start();
if ($_POST['modo'] == 3) {
    	    $controller = new ControllerAlumno();
	    $controller->invoke();

}else{
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerAlumno();
	    $controller->invoke();
	}	
}
}
//$_POST = array();
