<?php
require '../model/Modelo.php';
require '../model/ModeloAlumnoGrupo.php';
require 'OperationsController.php';

class ControllerRetirados implements OperationsController {
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
               
                $this->eliminar();
            }
            if ($_POST['modo'] == 2) {
               $this->activar($id);
             }
             if ($_POST['modo'] == 3) {
                echo $this->getDetalleRetiro($id);
              }
              
        }
    }
    public function conseguir() {
        $id = $_POST['id'];
        echo $this->model->getRegistroPorId($id);
    }

    public function agregar() {
    }

    public function eliminar() {
        $id = $_POST['id'];
        $this->model->updEstRegPorId($id,0);
        
    }

    public function inicio() {
        $modeloGrupo = new ModeloAlumnoGrupo();
        $idPeriodo=$_SESSION['IdPeriodo'];
        //estado 2 para los retirados
        $info = $modeloGrupo->getListaJoinGrupoAlumnoAll($idPeriodo,2);
        
        include '../viewPhp/gestionRetirados.php';
    }

    public function modificar() {
      
    }
  
    public function activar($idAlumnoGrupo) {
        echo $this->model->updEstRegPorId($idAlumnoGrupo,1);
        
    }
    public function getDetalleRetiro($codigoAlumno){
        //estado de retirados es 2
        return $this->model->getListaJoinPorEstado($codigoAlumno,"2");
    }
}

session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerRetirados();
	    $controller->invoke();
	}	
}
