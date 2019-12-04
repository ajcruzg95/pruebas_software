<?php
require '../model/Modelo.php';
require '../model/ModeloSede.php';
require "OperationsController.php";
class ControllerSede implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloSede();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['SedeNombre']);
        
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);
        $estaActivando = isset($_POST['activar']);
        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando && !$estaActivando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdSede']);
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

    public function agregar() {
        $id = ($_POST['IdSede']);
        $nombre = $_POST['SedeNombre'];
        $sede=new Sede($id, $nombre);
        $this->model->addRegistro($sede);
        $this->inicio();
    }

    public function conseguir() {
        $id = $_POST['id'];
        $sede = $this->model->getRegistroPorId($id);
        echo $sede;
    }

    public function eliminar() {        
        $id = ($_POST['id']);
        $this->model->delRegistroPorId($id);
    }

    public function inicio() {
        $sedes = $this->model->getLista();
        include '../viewPhp/gestionSede.php';
    }

    public function modificar() {
        $id = ($_POST['IdSede']);
        $nombre = $_POST['SedeNombre'];
        $sede = new Sede($id, $nombre);
        $this->model->updRegistro($sede);
        $this->inicio();
    }
     public function activar() {
        
        $id = ($_POST['activar']);
        $sede = new Sede($id, "","1");
        $this->model->desactivar();
        $this->model->activar($sede);
        $this->inicio();
    }
}
session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerSede();
	    $controller->invoke();
	}	
}
