<?php
require('fpdf/fpdf.php');

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
    $this->FPDF($orientation,$unit,$size);
    //$this->__construct($orientation,$unit,$size);
    $this->SetMargins(25, 20 , 25);
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
    $this->Image('../imagenes/unsa.png', 125, 30,60);
    $this->Image('../imagenes/logounsa.png', 90, 25,24);
    //$this->Image('../imagenes/marca.png', 52, 90,100);
    $l = 50;
    $md = 10;

    $alt = '';

    $td = 14;
    $tld = 10;

    //inicio de las lineas punteadas
    $tll = 132;
    //margen de las lineas punteadas
    $tml = 30;

    
    
    $this->SetTextColor(99, 4, 28 );
    $this->SetFont('Times', 'B', 14);
    $this->SetDrawColor(99, 4, 28);
    $this->Cell(0, 12, utf8_decode(''), 0,1,'R');
    $this->Cell(0, 6, utf8_decode('Oficina de Promoción de'), 0,1,'L');
    $this->Cell(0, 6, utf8_decode('Arte, Cultura, Deporte'),0,1,'L');
    $this->Cell(0, 6, utf8_decode('  y Recreación'),0,1,'L');
    
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
    $this->SetTextColor(57, 46, 60);
    $this->Ln(5);
    $this->Cell(0, 20,utf8_decode('CONSTANCIA DE PRE-INSCRIPCIÓN'),0,1,'C' );
    
    $this->SetTextColor(0, 0, 0);
    //$this->Write($l+20,utf8_decode('CONSTANCIA DE INSCRIPCIÓN '),0,1,'C');
    $this->Ln(5);
    $this->Cell(0, 0,utf8_decode(''),1,1,'L' );
    $this->Ln(5);
    $this->SetFont('Times', 'B', 18);
    $this->SetDash(1,1);

    $this->SetTextColor(99, 4, 28);
    $this->Cell(0, 20,utf8_decode('DATOS DEL ALUMNO: '),0,1,'L' );
    $this->SetTextColor(0, 0, 0);

    $this->Ln(2);
    $this->SetFont('Times', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('CUI: '),0,0,'L' );
    $this->SetFont('Times', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->cui),0,1,'L' );
    $this->Line($tml,$tll,170,$tll);

    $this->Ln(2);
    $this->SetFont('Times', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('NOMBRE: '),0,0,'L' );
    $this->SetFont('Times', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->nombre),0,1,'L' );
    $this->Line($tml,$tll+12,170,$tll+12);

    $this->Ln(2);
    $this->SetFont('Times', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('TALLER: '),0,0,'L' );
    $this->SetFont('Times', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->taller),0,1,'L' );
    $this->Line($tml,$tll+24,170,$tll+24);
    
    $this->Ln(2);
    $this->SetFont('Times', 'B', $td);
    $this->Cell($md, $tld,utf8_decode(''),0,0,'L' );
    $this->Cell(50, $tld,utf8_decode('GRUPO: '),0,0,'L' );
    $this->SetFont('Times', 'I', $td);
    $this->Cell(100, $tld,utf8_decode($this->grupo),0,1,'L' );
    $this->Line($tml,$tll+36,170,$tll+36);
    
    $this->SetDash(1,0);
    //$this->Rect(11, 108, 167, 60 ,'D');
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

