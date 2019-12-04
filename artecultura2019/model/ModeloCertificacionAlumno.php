<?php
include '../DAO/PDF.php';

class ModeloCertificacionAlumno extends Modelo{
    public function __construct() {
        parent::__construct();
    }

    public function crearCertificacionAlumnos($idCurso,$ddude,$da,$japacdr){
      $sql = "SELECT curso.CursoNombre AS curso,alumno.AlumnoNombre, alumno.AlumnoApellido FROM (((alumnogrupo INNER JOIN grupo ON alumnogrupo.IdGrupo = grupo.IdGrupo) INNER JOIN curso ON grupo.IdCurso=curso.IdCurso) INNER JOIN alumno ON alumnogrupo.IdAlumno = alumno.IdAlumno) WHERE grupo.IdGrupo = ".$idCurso." and alumnogrupo.AlumnoGrupoEstado=4";
      $result = parent::getConn()->query($sql);

      $w = 297;
      $h = 210; 
      // tweak these values (in pixels)
      $mw = 800;
      $mh = 500;
      $pdf = new PDF('L','mm','A4',$ddude,$da,$japacdr);
      $pdf->AliasNbPages();

      
      /*
      $htmlTable='<p  align="justify">Por su destacada labor en el <b>DICTADO DEL TALLER EXTRACURRICULAR 2018-I DE "  LECTURAS LITERARIAS - POESIA"</b>, realizado con una duración de 32 horas prácticas durante los meses de abril y mayo del 2018; programado en cumplimiento de lo establecido por la Dirección Universitaria de Formación Académica, habiendo cumplido su labor con responsabilidad y destreza en la enseñanza de dicha disciplina. Por lo que le expresamos nuestro agradecimiento imperecedero.</p>';
      $pdf->WriteHTML(utf8_decode($htmlTable));*/

      //hh

      $pdf->SetFont('Arial','',10);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', 'B', 30);
        $linea = 20;
        $pdf->Ln(-5);
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(0,25,utf8_decode($row['AlumnoNombre']." ".$row['AlumnoApellido']),0,1,'C');
        $pdf->Cell(22);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(230, 8,
         utf8_decode('Por su destacada labor en el DICTADO DEL TALLER EXTRACURRICULAR 2018-I DE "'.$row['curso'].'", realizado con una duración de 32 horas prácticas durante los meses de abril y mayo del 2018; programado en cumplimiento de lo establecido por la Dirección Universitaria de Formación Académica, habiendo cumplido su labor con responsabilidad y destreza en la enseñanza de dicha disciplina. Por lo que le expresamos nuestro agradecimiento imperecedero.
  '),0 );

      }
        $pdf->Output();
    }
    public function crearCertificacionAlumno($id,$idCurso,$ddude,$da,$japacdr){
      $sql="SELECT * FROM `curso` WHERE IdCurso=".$idCurso."";
      $result = parent::getConn()->query($sql);
      $outp = $result->fetch_all(MYSQLI_ASSOC);
      $nombre = $outp[0]['CursoNombre'];
      $sql = "SELECT * FROM `alumno` WHERE AlumnoCodigo = ".$id;
      $result = parent::getConn()->query($sql);

      $w = 297;
      $h = 210; 
      // tweak these values (in pixels)
      $mw = 800;
      $mh = 500;
      $pdf = new PDF('L','mm','A4',$ddude,$da,$japacdr);
      $pdf->AliasNbPages();

      
      /*
      $htmlTable='<p  align="justify">Por su destacada labor en el <b>DICTADO DEL TALLER EXTRACURRICULAR 2018-I DE "  LECTURAS LITERARIAS - POESIA"</b>, realizado con una duración de 32 horas prácticas durante los meses de abril y mayo del 2018; programado en cumplimiento de lo establecido por la Dirección Universitaria de Formación Académica, habiendo cumplido su labor con responsabilidad y destreza en la enseñanza de dicha disciplina. Por lo que le expresamos nuestro agradecimiento imperecedero.</p>';
      $pdf->WriteHTML(utf8_decode($htmlTable));*/

      //hh

      $pdf->SetFont('Arial','',10);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', 'B', 30);
        $linea = 20;
        $pdf->Ln(-5);
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->Cell(0,25,utf8_decode($row['AlumnoNombre']." ".$row['AlumnoApellido']),0,1,'C');
        $pdf->Cell(22);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(230, 8,
         utf8_decode('Por su destacada labor en el DICTADO DEL TALLER EXTRACURRICULAR 2018-I DE "'.$nombre.'", realizado con una duración de 32 horas prácticas durante los meses de abril y mayo del 2018; programado en cumplimiento de lo establecido por la Dirección Universitaria de Formación Académica, habiendo cumplido su labor con responsabilidad y destreza en la enseñanza de dicha disciplina. Por lo que le expresamos nuestro agradecimiento imperecedero.
  '),0 );

      }
        $pdf->Output();
    }

    /*
SELECT curso.CursoNombre AS curso, grupo.GrupoNombre AS grupo,alumnogrupo.IdGrupo AS id FROM (((alumnogrupo INNER JOIN grupo ON alumnogrupo.IdGrupo = grupo.IdGrupo) INNER JOIN curso ON grupo.IdCurso=curso.IdCurso) INNER JOIN alumno ON alumnogrupo.IdAlumno = alumno.IdAlumno) WHERE alumno.AlumnoCodigo = '20130873'
    */

    public function getTalleresAlumno($id){
        $sql="SELECT curso.CursoNombre AS curso, grupo.GrupoNombre AS grupo,curso.IdCurso AS id FROM (((alumnogrupo INNER JOIN grupo ON alumnogrupo.IdGrupo = grupo.IdGrupo) INNER JOIN curso ON grupo.IdCurso=curso.IdCurso) INNER JOIN alumno ON alumnogrupo.IdAlumno = alumno.IdAlumno) WHERE alumno.AlumnoCodigo = ".$id." and grupo.GrupoEstado=2";
        $result = parent::getConn()->query($sql);
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }
    public function getTalleres($idPeriodo){
        $sql="SELECT curso.CursoNombre AS curso,
        grupo.GrupoNombre AS grupo,
        grupo.IdGrupo AS id 
        FROM grupo
         INNER JOIN curso ON grupo.IdCurso=curso.IdCurso where grupo.IdPeriodo=" . $idPeriodo." and grupo.GrupoEstado=1" ;
        $result = parent::getConn()->query($sql);
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        
        return json_encode($outp);
    }

}
