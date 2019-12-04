<?php
require '../model/Modelo.php';

require '../model/ModeloUsuario.php';
require '../model/ModeloDocente.php';

require  '../model/ModeloPeriodo.php';

require '../model/ModeloGrupo.php';
require_once '../conexion/conexion.php';
class ControllerLogin {

    private $model;

    public function __construct() {
        $this->model = new ModeloUsuario();
    }

    public function invoke() {
        $estaCompleto = isset($_POST['idusuario']) && isset($_POST['contrasenia']);
        if ($estaCompleto) {
            $id = $_POST['idusuario'];
            $contrasenia = $_POST['contrasenia'];
            $usuario = json_decode($this->model->getRegistroPorId($id), true);
            
            //echo json_encode($usuario);
            if (count($usuario) > 0) {
                if (strcmp($contrasenia, $usuario['UsuarioContrasenia']) == 0) {
                    //crear su menu
                    $_SESSION['IdUsuario'] = $id;
                  
                    $model = new ModeloDocente();
                    $model1 = new ModeloGrupo();
                    $tabla = "docente";
                    $campo = "docentedni";
                    $json = json_encode($model->getListaPorCampo($tabla, $campo, $id));
                    //echo $json;
                    $docente = json_decode($json, true);
                    if (count($docente) > 0) {
                        $idDocente = $docente[0]['IdDocente'];
                        $json1 = $model1->getRegistroPorIdDocente($idDocente);
                        $grupo = json_decode($json1, true);
                        $idGrupo = $grupo['IdGrupo'];

                        $_SESSION['IdDocente'] = $idDocente;
                        
                        include '../controller/ControladorAsistencia.php';
                    } else if ($usuario['IdTipoUsuario'] == 1) {
                        $_SESSION['IdTipoUsuario'] = 1;
                        include '../viewPhp/gestionHome.php';
                    } else {
                        $msg = "Ingrese el usuario como docente";
                        include '../login.php';
                    }
                } else {
                    $msg = "Ingrese la contraseña correcta";
                    include '../login.php';
                }
            } else {
                $msg = "El usuario que ingreso no existe.";
                include '../login.php';
            }
        } else {
            if (isset($_POST['idusuario'])) {
                $msg = "Ingrese usuario";
            } else if (isset($_POST['contrasenia'])) {
                $msg = "Ingrese contraseña";
            }
            include '../login.php';
        }
    }

    public function inicio() {
        echo "inicio";
        //include '../login.php';
    }

    

}
//if(isset($_SESSION)){
//    session_destroy();
//}
session_start();
if (!isset($_SESSION['IdUsuario']) && !isset($_SESSION['IdTipoUsuario'])) {
    $controller = new ControllerLogin();
    $controller->invoke();
} else {
    if (isset($_SESSION['IdUsuario'])){
        $id = $_SESSION['IdUsuario'];
        $siguienteControlador = '../controller/ControladorAsistencia.php';
        $modelUsuario = new ModeloUsuario();
        $modelUsuario->recuperarSesion($id);
    }else{
        $siguienteControlador ='../viewPhp/gestionHome.php';
    }
    include $siguienteControlador;
}
$modelPeriodo = new ModeloPeriodo();

$periodoActivo = $modelPeriodo->getIdActivo();
$jsonPeriodoActivo = json_decode($periodoActivo, true);
$idPeriodoActivo = $jsonPeriodoActivo['IdPeriodo'];

$_SESSION['IdPeriodo'] = $idPeriodoActivo;

