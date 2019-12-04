<?php

require  '../model/Modelo.php';
require  '../model/ModeloPeriodo.php';
require  '../model/ModeloCertificacionAlumno.php';

class ControllerCertificacionAlumno{


    public function __construct() {
    }

    public function invoke() {
        $modelo = new ModeloCertificacionAlumno();
        


        $modo = isset($_POST['modo']);
        if(!$modo){
            include '../viewPhp/gestionCertificacionAlumno.php';
        	//$modelo->crearCertificacionAlumnos();
        }elseif($modo && ($_POST['modo']==1)){
        }elseif($modo && ($_POST['modo']==2)){
        }elseif($modo && ($_POST['modo']==3)){
            
            
            echo "".$modelo->getTalleresAlumno($_POST['cui']);
        }elseif($modo && ($_POST['modo']==4)){
            $modelPeriodo = new ModeloPeriodo();

            $periodoActivo = $modelPeriodo->getIdActivo();
            $jsonPeriodoActivo = json_decode($periodoActivo, true);
            $idPeriodo = $jsonPeriodoActivo['IdPeriodo'];
            
            echo "".$modelo->getTalleres($idPeriodo);
        }

        //echo "ggwp";
    }
}
session_start();
if (isset($_SESSION['IdTipoUsuario']) ) {
	if (($_SESSION['IdTipoUsuario'])==1 ) {

    	    $controller = new ControllerCertificacionAlumno();
	    $controller->invoke();
	}	
}
