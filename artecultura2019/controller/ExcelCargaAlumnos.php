<?php
    ob_start();
    
        
    require '../vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
    //require_once __DIR__ . '.\..\vendor\autoload.php';

    $objPHPExcel = new PHPExcel();
    //$objReader = PHPExcel_IOFactory::createReader('Excel2007');
    
    ini_set('max_execution_time', 10);
    $archivo = $_FILES['adjunto']['name'];
    $tipo = $_FILES['adjunto']['type'];
    $destino = './tmp/' . $archivo;
    
    if (copy($_FILES['adjunto']['tmp_name'], $destino)){
        //echo "Archivo Cargado Con Éxito\n";
    }else {
        //echo'<script type="text/javascript">
          //      alert("Error al cargar archivo.");
            //    window.location.href="../viewPhp/excelGrupoAlumno.php"
              //  </script>';
        $response ="Error al cargar archivo.";
        die(json_encode($response));   
    }
    
    include '../conexion/conexion.php';
    
    $objReader = PHPExcel_IOFactory::createReaderForFile($destino);
    $objPHPExcel = $objReader->load($destino);
    // Indicamos que se pare en la hoja uno del libro
    $worksheet=$objPHPExcel->getActiveSheet();
    $filas = $worksheet->getHighestRow();
    
    for ($i = 7; $i <= $filas; $i++) {
        $cui = $worksheet->getCell('A'.$i)->getValue();
        
        $idAlumno = verificarCui($cui);
      
        if ($idAlumno == -1) {
    
            $cui = $worksheet->getCell('A'.$i)->getValue();
    	    $nombreAlumno = $worksheet->getCell('B'.$i)->getValue();
    
            $apellidos = getApellidos($nombreAlumno);
            $nombre = getNombres($nombreAlumno);
    	    $nombreEscuela = $worksheet->getCell('C'.$i)->getValue();
    		
            registrarAlumno($cui, $apellidos, $nombre, $nombreEscuela);
        //$sqlTotal = $sqlTotal.$sql;
        }    
        
    }
    
    $response ="Completado satisfactoriamente ";
    die(json_encode($response));    
    //echo $sqlTotal;
    //$c = new Conexion();
    //$con = $c->getConexion();
    //$con->multi_query($sqlTotal);
    //mysqli_multi_query($con, $sqlTotal);
    
    
    //window.location.href="../viewPhp/gestionCargaAlumno.php"
    //echo'<script type="text/javascript">
    //  alert("Alumnos registrados.");
      
    //  </script>';
    
    //----------------------------------------------------------------------------------------------
    ////----------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------
    // FUNCIONES
    
    
    function getNombres($nombreCompleto) {
        $resp = substr($nombreCompleto, strpos($nombreCompleto, ',') + 2);
        // $resp = str_replace("/", " ", $resp);
        return $resp;
    }
    
    function getApellidos($nombreCompleto) {
        $resp = substr($nombreCompleto, 0, strpos($nombreCompleto, ','));
        $resp = str_replace("/", " ", $resp);
        return $resp;
    }
    
    function verificarCui($cui) {
        $sql = "SELECT IdAlumno FROM alumno WHERE AlumnoCodigo=" . $cui;
        $c = new Conexion();
        $con = $c->getConexion();
        $result = $con->query($sql);
    
        $resp = '-1';
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resp = $row['IdAlumno'];
            }
        }
        return $resp;
    }
    
    function registrarAlumno($cui, $apellidos, $nombre, $escuela) {
        $sql = "SELECT IdEscuela FROM escuela WHERE NombreEscuela='" . $escuela."'";
        $c = new Conexion();
        $con = $c->getConexion();
        $result = $con->query($sql);
        $idEscuela=-1;
    	
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idEscuela = $row['IdEscuela'];
            }
        }
    	
    	// $con->close();
    	// con = $c->getConexion();
    	
    	//if ($idEscuela==-1){
    	//	insertarEscuela($escuela);
    	//	registrarAlumno($cui, $apellidos, $nombre, $escuela);
    	//} else {
    		$sql = "INSERT INTO `alumno` (`AlumnoCodigo`, `AlumnoNombre`, `AlumnoApellido`, `IdEscuela1`) VALUES (" . $cui . ", '" . $nombre . "', '" . $apellidos . "', ".$idEscuela.");";
    		$con->query($sql);
    	//}
        
    
    }
    
    function insertarEscuela($nomEscuela){
    	$sql = "INSERT INTO `escuela` (`idEscuela`, `idFacultad`, `NombreEscuela`, `EscuelaEstado`) VALUES (NULL, -1, '" . $nomEscuela . "', 1);";
    	echo("escuela -> ".$sql);
    	$c = new Conexion();
    	$con = $c->getConexion();
    	$con->query($sql);
    	
    	$con->close();
    }

?>
