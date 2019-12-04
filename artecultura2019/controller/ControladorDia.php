<?php

require '../model/Modelo.php';
require '../model/ModeloDia.php';
require "OperationsController.php";
class Controller implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloDia();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['DiaDescripcion']);
        
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['idDia']);
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
        $id = ($_POST['idDia']);
        $descripcion = $_POST['DiaDescripcion'];
        $dia = new Dia($id, $descripcion);

        $this->model->addRegistro($dia);
        $dias = $this->model->getLista();

        include '../viewPhp/gestionDia.php';
    }

    public function conseguir() {
        $id = ($_POST['id']);
        $dias = $this->model->getLista();
        $dia = $this->model->getRegistroPorId($id);
        echo $dia;
    }

    public function eliminar() {
        $id = ($_POST['id']);
        $this->model->delRegistroPorId($id);
        $dias = $this->model->getLista();
        echo $dias;
    }

    public function inicio() {
        $dias = $this->model->getLista();
        include '../viewPhp/gestionDia.php';
    }

    public function modificar() {
        $id = ($_POST['idDia']);
        $descripcion = $_POST['DiaDescripcion'];
        $dia = new Dia($id, $descripcion);

        $this->model->updRegistro($dia);
        $dias = $this->model->getLista();

        include '../viewPhp/gestionDia.php';
    }

}

session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new Controller();
	    $controller->invoke();
	}	
}
