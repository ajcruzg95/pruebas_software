<?php

require '../model/Modelo.php';
require '../model/ModeloLugar.php';
require "OperationsController.php";
class ControllerLugar implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloLugar();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['LugarNombre']);
        
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdLugar']);
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
        }
    }

    public function agregar() {
        $id = ($_POST['IdLugar']);
        $nombre = $_POST['LugarNombre'];
        $lugar = new Lugar($id, $nombre);
        $this->model->addRegistro($lugar);
        $this->inicio();
    }

    public function conseguir() {
        $id = $_POST['id'];
        $lugares = $this->model->getLista();
        $lugar = $this->model->getRegistroPorId($id);
        echo $lugar;
    }

    public function eliminar() {        
        $id = ($_POST['id']);
        echo $this->model->delRegistroPorId($id);
        $lugares = $this->model->getLista();
        echo $lugares;
    }

    public function inicio() {
        $lugares = $this->model->getLista();
        include '../viewPhp/gestionLugar.php';
    }

    public function modificar() {
        $id = ($_POST['IdLugar']);
        $nombre = $_POST['LugarNombre'];
        $lugar = new Lugar($id, $nombre);
        $this->model->updRegistro($lugar);
        
        $this->inicio();
    }

}

session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerLugar();
	    $controller->invoke();
	}	
}

