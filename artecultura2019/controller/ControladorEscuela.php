<?php

require '../model/Modelo.php';
require '../model/ModeloFacultad.php';
require '../model/ModeloEscuela.php';

require '../model/ModeloUsuario.php';
require '../model/ModeloDocente.php';
require '../model/ModeloGrupo.php';

require 'OperationsController.php';

class ControllerEscuela implements OperationsController {

    public $model;

    public function __construct() {
        $this->model = new ModeloEscuela();
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['NombreEscuela']);

        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdEscuela']);
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

    public function conseguir() {
        $id = $_POST['id'];
        $escuela = $this->model->getRegistroPorId($id);
        echo $escuela;
    }

    public function agregar() {
        $facultad = new Facultad($_SESSION['idfacultad']);
        $nombre = $_POST['NombreEscuela'];
        $escuela = new Escuela("", $facultad, $nombre);
        $this->model->addRegistro($escuela);
        $this->inicio();
    }

    public function eliminar() {
        $id = $_POST['id'];
        echo $this->model->delRegistroPorId($id);
    }

    public function inicio() {
        $idFacultad = $_SESSION["idfacultad"];
        $escuelas = $this->model->getListaJoin($idFacultad);
        $modeloFacultad = new ModeloFacultad();
        $facultad = json_decode($modeloFacultad->getRegistroPorId($_SESSION["idfacultad"]), true);
        include '../viewPhp/gestionEscuela.php';
    }

    public function modificar() {
        $id = $_POST['IdEscuela'];
        $facultad = new Facultad($_SESSION['idfacultad']);
        $nombre = $_POST['NombreEscuela'];
        $escuela = new Escuela($id, $facultad, $nombre);
        $this->model->updRegistro($escuela);
        $this->inicio();
    }

}

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST["IdFacultad"])) {
    $_SESSION["idfacultad"] = $_POST["IdFacultad"];
    $controller = new ControllerEscuela();
    $controller->invoke();
} 


    
