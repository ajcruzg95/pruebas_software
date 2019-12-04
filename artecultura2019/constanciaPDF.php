<?php
require('pdf/fpdf.php');

class PDFPRE extends FPDF
{
var $cui;
var $nombre;
var $taller;
var $grupo;
// Cabecera de página
function PDFPRE($orientation='P', $unit='mm', $size='A4',$cui,$nombre,$taller,$grupo)
{
    // Call parent constructor
    //$this->FPDF($orientation,$unit,$size);
    $this->__construct($orientation,$unit,$size);
    $this->cui = $cui;
    $this->nombre = $nombre;
    $this->taller = $taller;
    $this->grupo = $grupo;
}
function Header()
{
    // Logo
    //$this->Image('logo_pb.png',10,8,33);
    // Arial bold 15
    //$this->Image('./imagenes/logo.png', 0, 0,297,210);
    $this->Image('./imagenes/unsa.png', 120, 16,80);
    $this->Image('./imagenes/logo.png', 90, 15,24);
    $l = 50;
    $md = 20;

    $alt = '';

    $td = 14;
    $tld = 10;
    $tll = 123;
    
    
    $this->SetTextColor(99, 4, 28 );
    $this->SetFont('Arial', 'B', 14);
    $this->SetDrawColor(99, 4, 28);
    $this->Cell(0, 12, utf8_decode(''), 0,1,'R');
    $this->Cell(0, 6, utf8_decode('Oficina de promoción de'), 0,1,'L');
    $this->Cell(0, 6, utf8_decode('Arte, Cultura, Deporte y'),0,1,'L');
    $this->Cell(0, 6, utf8_decode('Recreación Cultura'),0,1,'L');
    
    $this->SetTextColor(0, 0, 0);
    $this->Ln(16);
    $this->Cell(0, 0,utf8_decode(''),1,1,'L' );
    //$this->Cell(95, 0, utf8_decode(''), 0);
    //$this->Write($l,'Para saber qué hay de nuevo en este tutorial, pulse ');
    //$this->Ln(1);
    //$this->Cell(95, 0, utf8_decode(''), 0);
    //$this->Cell(80, 39, utf8_decode('Cultura, Deporte y Recreación'), 0);
    //$this->Ln(1);
    
    $this->SetFont('Arial', 'B', 24);
    $this->Ln(5);
    $this->Cell(0, 20,utf8_decode('CONSTANCIA DE INSCRIPCIÓN'),0,1,'C' );
    
    
    //$this->Write($l+20,utf8_decode('CONSTANCIA DE INSCRIPCIÓN '),0,1,'C');
    $this->Ln(5);
    $this->Cell(0, 0,utf8_decode(''),1,1,'L' );
    $this->Ln(5);
    $this->SetFont('Arial', 'B', 18);
    $this->SetDash(1,1);

    $this->SetTextColor(99, 4, 28);
    $this->Cell(0, 20,utf8_decode('   DATOS DEL ALUMNO: '),0,1,'L' );
    $this->SetTextColor(0, 0, 0);

    $this->Ln(2);
    $this->SetFont('Arial', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('CUI: '),0,0,'L' );
    $this->SetFont('Arial', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->cui),0,1,'L' );
    $this->Line(30,$tll,170,$tll);

    $this->Ln(2);
    $this->SetFont('Arial', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('NOMBRE: '),0,0,'L' );
    $this->SetFont('Arial', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->nombre),0,1,'L' );
    $this->Line(30,$tll+12,170,$tll+12);

    $this->Ln(2);
    $this->SetFont('Arial', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('TALLER: '),0,0,'L' );
    $this->SetFont('Arial', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->taller),0,1,'L' );
    $this->Line(30,$tll+24,170,$tll+24);
    
    $this->Ln(2);
    $this->SetFont('Arial', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('GRUPO: '),0,0,'L' );
    $this->SetFont('Arial', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->grupo),0,1,'L' );
    $this->Line(30,$tll+36,170,$tll+36);
    
    $this->SetDash(1,0);
    //$this->Rect(17, 110, 167, 60 ,'D');
    //$this->Write($l+30,'DATOS DEL ALUMNO');
    

    $this->Ln(1);
    $this->SetFont('Arial', 'B', 16);
}
function SetDash($black=false, $white=false)
{
    if($black and $white)
        $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
    else
        $s='[] 0 d';    
    $this->_out($s);
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-17);
    $this->SetDash(1,0);
    $this->SetDrawColor(99, 4, 28);
    $this->Cell(0, 0, '', 1,1,'R');
    $this->Ln(3);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
?>
