<?php

require '../model/Modelo.php';
require '../model/ModeloSede.php';
require '../model/ModeloPeriodo.php';
require 'OperationsController.php';

class ControllerPeriodo implements OperationsController {

    public $model;
    
    public function __construct() {
        $this->model = new ModeloPeriodo();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['PeriodoAnio'])&&
                isset($_POST['PeriodoNumero']) ;

        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);
        $estaActivando = isset($_POST['activar']);
        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando&&!$estaActivando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdPeriodo']);
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
        }elseif ($estaActivando) {
            $this->activar();
        }
    }

    public function conseguir() {
        $id = $_POST['id'];
        $escuela = $this->model->getRegistroPorId($id);
        echo $escuela;
    }

    public function agregar() {
        $sede = $_SESSION['idsede'];
        $anio=$_POST['PeriodoAnio'];
        $numero=$_POST['PeriodoNumero'];
        $periodo=new Periodo("", $sede, $anio, $numero);
        $this->model->addRegistro($periodo);
        $this->inicio();
    }

    public function eliminar() {
        $id = $_POST['id'];
        echo $this->model->delRegistroPorId($id);
    }

    public function inicio() {
        $idSede=$_SESSION["idsede"];
        $periodos = $this->model->getListaJoin($idSede);
        $modeloSede = new ModeloSede();
        $sede = json_decode($modeloSede->getRegistroPorId($_SESSION["idsede"]),true);
        include '../viewPhp/gestionPeriodo.php';
    }

    public function modificar() {
        $id = $_POST['IdPeriodo'];
        $sede = $_SESSION['idsede'];
        $anio=$_POST['PeriodoAnio'];
        $numero=$_POST['PeriodoNumero'];
        $periodo=new Periodo($id, $sede, $anio, $numero);
        $this->model->updRegistro($periodo);
        $this->inicio();
        
    }
    public function activar() {
        $id = ($_POST['activar']);
        $_SESSION['IdPeriodo'] = $id;
        $activo="1";
        $periodo = new Periodo($id, "", "", "", $activo);
        $this->model->desactivar();
        $this->model->activar($periodo);
        $this->inicio();
    }
}

session_start();
if (isset($_POST["IdSede"])) {
    $_SESSION["idsede"] = $_POST["IdSede"];
    $controller = new ControllerPeriodo();
    $controller->invoke();
}else{
	if (isset($_SESSION["idsede"])) {
	    $controller = new ControllerPeriodo();
    	$controller->invoke();
	}

}


