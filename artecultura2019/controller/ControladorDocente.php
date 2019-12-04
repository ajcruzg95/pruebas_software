<?php

require '../model/Modelo.php';
require '../model/ModeloDocente.php';
require 'OperationsController.php';

class Controller implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloDocente();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['DocenteNombre']) &&
                isset($_POST['DocenteApellido']) && isset($_POST['DocenteCodigo']) &&
                isset($_POST['DocenteDNI']) && isset($_POST['DocenteContra']) &&
                isset($_POST['DocenteCorreo']) && isset($_POST['DocenteCelular']);
        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdDocente']);
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
        $id = ($_POST['IdDocente']);
        $nombre = $_POST['DocenteNombre'];
        $apellido = $_POST['DocenteApellido'];
        $codigo = $_POST['DocenteCodigo'];
        $dni = $_POST['DocenteDNI'];
        $contra = $_POST['DocenteContra'];
        $correo = $_POST['DocenteCorreo'];
        $celular = $_POST['DocenteCelular'];
        $estado = 1;
        $builderDocente = new BuilderDocente($id, $nombre, $apellido, $codigo);
        $builderDocente->dni($dni);
        $builderDocente->contrasenia($contra);
        $builderDocente->correo($correo);
        $builderDocente->celular($celular);
        $builderDocente->estado($estado);
        $docente = new Docente($builderDocente);

        $this->model->addRegistro($docente);
        $this->inicio();
    }

    public function conseguir() {
        $id = $_POST['id'];
        $docentes = $this->model->getLista();
        $docente = $this->model->getRegistroPorId($id);
        echo $docente;
    }

    public function eliminar() {
        $id = $_POST['id'];
        $this->model->delRegistroPorId($id);
        $docentes = $this->model->getLista();
        echo $docentes;
    }

    public function inicio() {
        $docentes = $this->model->getLista();
        include '../viewPhp/gestionDocente.php';
    }

    public function modificar() {
        $id = ($_POST['IdDocente']);
        $nombre = $_POST['DocenteNombre'];
        $apellido = $_POST['DocenteApellido'];
        $codigo = $_POST['DocenteCodigo'];
        $dni = $_POST['DocenteDNI'];
        $contra = $_POST['DocenteContra'];
        $correo = $_POST['DocenteCorreo'];
        $celular = $_POST['DocenteCelular'];
        $estado = 1;
        $builderDocente = new BuilderDocente($id, $nombre, $apellido, $codigo);
        $builderDocente->dni($dni);
        $builderDocente->contrasenia($contra);
        $builderDocente->correo($correo);
        $builderDocente->celular($celular);
        $builderDocente->estado($estado);
        $docente = new Docente($builderDocente);

        echo $this->model->updRegistro($docente);
        $this->inicio();
    }

}


session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new Controller();
	    $controller->invoke();
	}	
}
