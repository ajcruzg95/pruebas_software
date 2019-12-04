<?php

require '../model/Modelo.php';
require '../model/ModeloGrupo.php';

require '../model/ModeloCurso.php';
require '../model/ModeloAlumnoGrupo.php';
require '../model/ModeloAlumno.php';
require '../model/ModeloPeriodo.php';


require '../model/ModeloHorario.php';
require '../model/ModeloDocente.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require "OperationsController.php";
require "../PHPMailer-master/src/Exception.php";
//use Exception;
class ControllerPrematricula implements OperationsController {

    public $model;
    public $elimino;

    public function __construct() {
        $this->model = new ModeloGrupo();
    }

    public function invoke() {

        $estaFormularioLleno = isset($_POST['IdGrupo']) && isset($_POST['IdCurso'])
                && isset($_POST['IdDocente']) && isset($_POST['GrupoNombre'])
                 && isset($_POST['GrupoCodigo']) && isset($_POST['GrupoCapacidad']);

        $estaFiltrando = isset($_POST['id']);
        $estaModificandoOEliminando = isset($_POST['modo']);

        if (!$estaFiltrando && !$estaFormularioLleno && !$estaModificandoOEliminando) {
            $this->inicio();
        } elseif (!$estaFiltrando && $estaFormularioLleno && !$estaModificandoOEliminando) {
            $id = $_POST['IdGrupo'];

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
            if ($_POST['modo'] == 3) {
                $this->getListaGrupo($id);
            }
            if ($_POST['modo'] == 4) {
                $this->getListaHorario($id);
            }
            if ($_POST['modo'] == 5) {

                $codigoGenerado=$this->generateRandomString(5,$id);
            echo $codigoGenerado;
                $this->enviarCodigoCorreo($id,$codigoGenerado);
           }
            if ($_POST['modo'] == 6) {
		    $codigoAlumno=$codigoGrupo=$cel=$percel=$pernom="";		
		
		if(isset($id)){
                   $codigoAlumno=$id;
		}
		
		if(isset($_POST['grup'])){
                	$codigoGrupo=($_POST['grup']);};
		if(isset($_POST['cel'])){
	                $cel=($_POST['cel']);};
		if(isset($_POST['percel'])){
        	        $percel=($_POST['percel']);};
		if(isset($_POST['pernom'])){
                	$pernom=($_POST['pernom']);};
		
		$this->preMatricular($codigoAlumno, $codigoGrupo);
		
	        $this->actualizarDatos($codigoAlumno, $cel,$percel,$pernom);

                }
        }
    }

	public function actualizarDatos($codigoAlumno, $cel,$percel,$pernom){
       
        //$_POST = array();
        $datos=array(
            "cel" => $cel,
             "pernom"    => $pernom,
             "percel"    => $percel);
        $modeloAlumno = new ModeloAlumno();
       
       $modeloAlumno->actualizarDatosEmergencia($datos,$codigoAlumno);

    }

	public function preMatricular($idAlumno, $idGrupo) {
        $grupo = new Grupo($idGrupo);
        $modelPeriodo = new ModeloPeriodo();
        $modelGrupo = new ModeloAlumnoGrupo();
	$modeloGrupo = new ModeloGrupo();
        $_POST = array();

        $modeloAlumno = $this->model->getListaPorCampo("alumno", "AlumnoCodigo", "\"" . $idAlumno . "\"");
        if(count($modeloAlumno)==0){
		$this->inicio();
		return;
	}
        $alumnoo = $modeloAlumno[0]['IdAlumno'];
	$alumno = new Alumno(new BuilderAlumno($alumnoo));
        
        $periodoActivo = $modelPeriodo->getIdActivo();
        $jsonPeriodoActivo = json_decode($periodoActivo, true);
        $idPeriodoActivo = $jsonPeriodoActivo['IdPeriodo'];
        
        $json =$modelGrupo->getRegistroPorAlumno($alumno,$idPeriodoActivo);
        $array= json_decode($json,true);
        $repetido = False; 
        if ($array != NULL) {
            $repetido=True;              
        }
        
        if(!$repetido){
			$alumnoGrupo = new AlumnoGrupo("", $grupo, $alumno, 5);
			$modelGrupo->addRegistro($alumnoGrupo);
	$codigoAlumnoPDF= $idAlumno;
	$alumnoNombrePDF=$modeloAlumno[0]['AlumnoNombre']." ".$modeloAlumno[0]['AlumnoApellido'];
	if($idGrupo==""){
		$this->inicio();	
		return;
	}	
	
	$jsonGrupo = $modeloGrupo->getListaId($idGrupo);
	$grupoTemp = json_decode($jsonGrupo,true);
	$nombrePDF = $grupoTemp['CursoNombre'];
	$grupoNombrePDF = $grupoTemp['GrupoNombre'];
	
      include '../DAO/pdfConstanciaAlumno.php';
$pdf = new PDFPRE('P','mm','A4',$codigoAlumnoPDF,$alumnoNombrePDF,$nombrePDF,$grupoNombrePDF);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Output(); 
        
        }else{
	$codigoAlumnoPDF= $idAlumno;
	$alumnoNombrePDF=$modeloAlumno[0]['AlumnoNombre']." ".$modeloAlumno[0]['AlumnoApellido'];

	if($array['IdGrupo']==""){
		$this->inicio();	
		return;
	}	
	$jsonGrupo = $modeloGrupo->getListaId($array['IdGrupo']);

        
	$grupoTemp = json_decode($jsonGrupo,true);
	$nombrePDF = $grupoTemp['CursoNombre'];
	$grupoNombrePDF = $grupoTemp['GrupoNombre'];
      include '../DAO/pdfConstanciaAlumno.php';
$pdf = new PDFPRE('P','mm','A4',$codigoAlumnoPDF,$alumnoNombrePDF,$nombrePDF,$grupoNombrePDF);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Output(); 
            echo "Ya te has pre-inscrito.Si deseas cambiar tu pre-inscripción visita la Oficina de Arte y Cultura";
        }
        //$modelGrupo->addRegistro($alumnoGrupo);
        
    }

    public function agregar() {
        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];
        
        $capacidad = $_POST['GrupoCapacidad'];
        $codigo=$_POST['GrupoCodigo'];
        //$idPeriodo = $_SESSION['IdPeriodo'] ;
        
        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre,$capacidad,$codigo);
       // $grupo->setPeriodo($idPeriodo);
        $this->model->addRegistro($grupo);
        $this->inicio();
    }


    public function conseguir() {
        $modeloCurso = new ModeloCurso();
        $modeloDocente = new ModeloDocente();

        $cursos = $modeloCurso->getLista();
        $docentes = $modeloDocente->getLista();
        
        $id = $_POST['id'];
        $grupo = $this->model->getRegistroPorId($id);
        echo $grupo;
    }

    public function eliminar() {
        $id = ($_POST['id']);
        echo $this->model->delRegistroPorId($id);
        $grupos = $this->model->getLista();
        echo $grupos;
    }

    public function inicio() {
        $modelPeriodo = new ModeloPeriodo();

        $periodoActivo = $modelPeriodo->getIdActivo();
        $jsonPeriodoActivo = json_decode($periodoActivo, true);
        $idPeriodoActivo = $jsonPeriodoActivo['IdPeriodo'];
        $modeloCurso = new ModeloCurso();
        $modeloDocente = new ModeloDocente();

        $cursos = $modeloCurso->getLista();
        $docentes = $modeloDocente->getLista();
                
        $grupos = $this->model->getListaJoin($idPeriodoActivo);
        //echo $cursos;
        include '../viewPhp/gestionPreMatricula.php';
    }

    public function modificar() {
        $id = $_POST['IdGrupo'];
        $idCurso = ($_POST['IdCurso']);
        $idDocente = $_POST['IdDocente'];
        $nombre = $_POST['GrupoNombre'];
        
        $capacidad = $_POST['GrupoCapacidad'];
        $codigo=$_POST['GrupoCodigo'];
        
        $curso = new Curso($idCurso);
        $docente = new Docente(new BuilderDocente($idDocente));
        $grupo = new Grupo($id, $curso, $docente, $nombre,$capacidad,$codigo);
        $this->model->updRegistro($grupo);
        $this->inicio();
    }
     public function cerrarGrupo($idGrupo) {
        
        $this->model->cambiarEstado($idGrupo);
        $this->model->cerrarGrupo($idGrupo);
    }
    public function getListaGrupo($id){
        $modelPeriodo = new ModeloPeriodo();

        $periodoActivo = $modelPeriodo->getIdActivo();
        $jsonPeriodoActivo = json_decode($periodoActivo, true);
        $idPeriodo = $jsonPeriodoActivo['IdPeriodo'];
        echo $this->model->getListaGrupoPorIdCursoConcupos($id,$idPeriodo);

    }
    public function getListaHorario($id){
        $modeloHorario=new ModeloHorario();
        echo $modeloHorario->getListaJoin($id);
    }

    public function generateRandomString($length = 5 , $correo) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $hoy = getdate();
        $regreso =md5($correo.$hoy['hours']);
        return substr($regreso, -5);
    } 

    public function enviarCodigoCorreo($correo,$codigoGenerado){

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "artecultura431@gmail.com";
        $mail->Password = "431contra";
        $mail->SetFrom('artecultura431@gmail.com');
        $mail->Subject = "Test";
        $mail->Body = "Hola qué tal, este es el código para tu pre-matricula: ".$codigoGenerado;
        $mail->AddAddress($correo);
        //$mail->MsgHTML("Hola que tal, esta es tu contraseña: ".$docente['DoncenteContra ']);
        if(!$mail->Send()) {
           // return $mail->ErrorInfo;
            return "no envié";
        } else {
          // throw new Exception();
        }
        //throw new Exception();
    }


   
}
//session_start();
$controller = new ControllerPrematricula();
$controller->invoke();
