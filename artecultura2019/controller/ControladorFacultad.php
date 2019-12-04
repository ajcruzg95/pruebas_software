<?php

require '../model/Modelo.php';
require '../model/ModeloFacultad.php';
require "OperationsController.php";
class ControllerFacultad implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloFacultad();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['FacultadNombre']);
        
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdFacultad']);
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
        $id = ($_POST['IdFacultad']);
        $nombre = $_POST['FacultadNombre'];
        $facultad = new Facultad($id, $nombre);
        $this->model->addRegistro($facultad);
        $this->inicio();
    }

    public function conseguir() {
        $id = $_POST['id'];
        $lugar = $this->model->getRegistroPorId($id);
        echo $lugar;
    }

    public function eliminar() {        
        $id = ($_POST['id']);
        $this->model->delRegistroPorId($id);
    }

    public function inicio() {
        $facultades = $this->model->getLista();
        include '../viewPhp/gestionFacultad.php';
    }

    public function modificar() {
        $id = ($_POST['IdFacultad']);
        $nombre = $_POST['FacultadNombre'];
        $facultad = new Facultad($id, $nombre);
        $this->model->updRegistro($facultad);
        $this->inicio();
    }

}
session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerFacultad();
	    $controller->invoke();
	}	
}





