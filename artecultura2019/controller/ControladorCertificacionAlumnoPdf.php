<?php

require '../model/Modelo.php';
require '../model/ModeloCertificacionAlumno.php';

class ControllerCertificacionAlumno{


    public function __construct() {
    }

    public function invoke() {
        $modelo = new ModeloCertificacionAlumno();
        $idGRUPO = isset($_POST['gidCurso']);
        $idCUI = isset($_POST['cui']);
        if($idGRUPO){
            $idCurso = $_POST['gidCurso'];
            $ddude = $_POST['gddude'];
            $da = $_POST['gda'];
            $japacdr = $_POST['gjapacdr'];
            $modelo->crearCertificacionAlumnos($idCurso,$ddude,$da,$japacdr);
        }elseif($idCUI){
            $cui = $_POST['cui'];
            $idCurso = $_POST['aidCurso'];
            $ddude = $_POST['addude'];
            $da = $_POST['ada'];
            $japacdr = $_POST['ajapacdr'];
            $modelo->crearCertificacionAlumno($cui,$idCurso,$ddude,$da,$japacdr);
        }
        //echo "ggwp";
    }
}
$controller = new ControllerCertificacionAlumno();
$controller->invoke();
