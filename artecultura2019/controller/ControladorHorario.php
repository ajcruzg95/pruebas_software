<?php

require '../model/Modelo.php';
require '../model/ModeloHorario.php';
require '../model/ModeloDia.php';
require '../model/ModeloLugar.php';
require '../model/ModeloGrupo.php';

require 'OperationsController.php';

class ControllerHorario implements OperationsController {

    public $model;
    static $idgrupo = 0;

    public function __construct() {
        $this->model = new ModeloHorario();
        //$this->idgrupo = $idgrupo;
    }

    public function invoke() {
        $estaFormularioLleno = isset($_POST['IdLugar']) && isset($_POST['IdDia']) &&
                isset($_POST['hora1']) && isset($_POST['minuto1']) &&
                isset($_POST['hora2']) && isset($_POST['minuto2']);

        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = ($_POST['IdHorario']);
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
        $horarios = $this->model->getLista();
        $horario = $this->model->getRegistroPorId($id);
        echo $horario;
    }

    public function agregar() {
        $fecha = '2020-06-30';
        $id = $_POST['IdHorario'];
        $grupo = new Grupo($_SESSION["idgrupo"]);
        $lugar = new Lugar($_POST['IdLugar']);
        $dia = new Dia($_POST['IdDia']);
        $hora1 = $_POST['hora1'];
        $minuto1 = $_POST['minuto1'];

        $entrada = $fecha . " " . $hora1 . ":" . $minuto1;
        $hora2 = $_POST['hora2'];
        $minuto2 = $_POST['minuto2'];
        $salida = $fecha . " " . $hora2 . ":" . $minuto2;
        $horario = new Horario($id, $grupo, $lugar, $dia, $entrada, $salida);
        $this->model->addRegistro($horario);
        $this->inicio();
    }

    public function eliminar() {
        $id = $_POST['id'];
        echo $this->model->delRegistroPorId($id);
        echo "<br>";
        $horarios = $this->model->getListaJoin($_SESSION["idgrupo"]);
        echo $horarios;
    }

    public function inicio() {
        $modeloDia = new ModeloDia();
        $modeloLugar = new ModeloLugar();
        $modeloGrupo = new ModeloGrupo();

        $dias = $modeloDia->getLista();
        $lugares = $modeloLugar->getLista();

        $grupo = json_decode($modeloGrupo->getListaId($_SESSION["idgrupo"]),true);
        
        $horarios = $this->model->getListaJoin($_SESSION["idgrupo"]);
        
        include '../viewPhp/gestionHorario.php';
    }

    public function modificar() {
        $fecha = '2020-06-30';
        $id = $_POST['IdHorario'];
        $grupo = new Grupo($_SESSION["idgrupo"]);
        $lugar = new Lugar($_POST['IdLugar']);
        $dia = new Dia($_POST['IdDia']);
        $hora1 = $_POST['hora1'];
        $minuto1 = $_POST['minuto1'];

        $entrada = $fecha . " " . $hora1 . ":" . $minuto1;
        $hora2 = $_POST['hora2'];
        $minuto2 = $_POST['minuto2'];
        $salida = $fecha . " " . $hora2 . ":" . $minuto2;
        $horario = new Horario($id, $grupo, $lugar, $dia, $entrada, $salida);
        $this->model->updRegistro($horario);
        $this->inicio();
    }

}

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["IdGrupo"])) {
    $_SESSION["idgrupo"] = $_POST["IdGrupo"];
}
    $controller = new ControllerHorario();
    $controller->invoke();


