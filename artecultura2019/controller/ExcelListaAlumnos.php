<?php
    ob_start();
    $conexion = new mysqli('localhost','root','','id7829199_asistenciapermiso',3306);
    if (mysqli_connect_errno()) {
        printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
        exit();
    }
    
    $idGrupoExiste = isset($_POST['IdGrupo']);
    if($idGrupoExiste){
        $idGrupo = $_POST['IdGrupo'];
        //$stringsql = "SELECT curso.CursoNombre AS curso,alumno.AlumnoNombre, alumno.AlumnoApellido";
        //$stringsql = $stringsql."SELECT curso.CursoNombre AS curso,alumno.AlumnoNombre";
        $stringsql = 'SELECT alumno.AlumnoNombre, alumno.AlumnoApellido,alumno.AlumnoCodigo ,escuela.NombreEscuela,facultad.FacultadNombre FROM (((((alumnogrupo INNER JOIN grupo ON alumnogrupo.IdGrupo = grupo.IdGrupo) INNER JOIN curso ON grupo.IdCurso=curso.IdCurso) INNER JOIN alumno ON alumnogrupo.IdAlumno = alumno.IdAlumno) INNER JOIN escuela ON escuela.IdEscuela = alumno.IdEscuela1) INNER JOIN facultad ON facultad.IdFacultad = escuela.IdFacultad) WHERE grupo.IdGrupo = '.$idGrupo.' and alumnogrupo.AlumnoGrupoEstado=1 ORDER BY alumno.AlumnoApellido ASC';
        $stringsqlcab = 'SELECT periodo.PeriodoAnio,periodo.PeriodoNumero,docente.DocenteNombre,docente.DocenteApellido,curso.CursoNombre,grupo.GrupoNombre FROM (((grupo INNER JOIN periodo ON grupo.IdPeriodo = periodo.IdPeriodo)INNER JOIN docente ON grupo.IdDocente=docente.IdDocente)INNER JOIN curso ON curso.IdCurso=grupo.IdCurso) WHERE grupo.IdGrupo = '.$idGrupo ;
        //$gg = "SELECT * FROM student";
        $result = $conexion->query($stringsql);
        $resultCab = $conexion->query($stringsqlcab);
        $outp = array();
        $outp = $resultCab->fetch_all(MYSQLI_ASSOC);
        //$result = $modelo->crearExcelListaAlumnos($idCurso);
        
        require '../vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
        //require_once __DIR__ . '.\..\vendor\autoload.php';

        $objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('EJEMPLO.xlsx');
        // Indicamos que se pare en la hoja uno del libro
        $objPHPExcel->setActiveSheetIndex(0);
        
        $i = 9;
        $nombreLibro=substr($outp[0]['CursoNombre'],0,18)."_G".$outp[0]['GrupoNombre'].".xlsx";
        //echo $nombreLibro;
        $objPHPExcel->getActiveSheet()->setTitle($nombreLibro);
        $stringDet = "TALLER EXTRACURRICULAR ".$outp[0]['PeriodoAnio']."-".$outp[0]['PeriodoNumero']." / ".$outp[0]['CursoNombre']." GRUPO: \"".$outp[0]['GrupoNombre']."\"";
        $objPHPExcel->getActiveSheet()->SetCellValue('A6',$stringDet );
        $objPHPExcel->getActiveSheet()->SetCellValue('A34', "INSTRUCTOR: ".$outp[0]['DocenteApellido'].", ".$outp[0]['DocenteNombre']);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $row['AlumnoCodigo']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$row['AlumnoApellido'].', '.$row['AlumnoNombre']);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, $row['NombreEscuela']);
            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, $row['FacultadNombre']);
            $i++;
        }
		
        //Guardamos los cambios
        /*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("Libro4555.xlsx");*/
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$nombreLibro);
        header('Cache-Control: max-age=0');
      
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
          //echo "idGrupo";
    }
?>
