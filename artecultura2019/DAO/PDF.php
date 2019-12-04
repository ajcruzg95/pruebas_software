<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		var $B;
		var $I;
		var $U;
		var $HREF;
		var $mes;
		var $d1;
		var $d2;
		var $d3;
		function Header()
		{

      		
      		$this->Image('../imagenes/c.jpg', 0, 0,297,210);
      		$this->Image('../imagenes/unsa.png', 55, 16,50);
      		$this->Image('../imagenes/logounsa.png', 35, 12,20);
      		$this->SetLineWidth(0.8);
			$this->SetTextColor(0, 0, 0);
		    $this->SetFont('Arial', '', 14);
		    $this->SetDrawColor(99, 4, 28);
		    $this->Ln(1);
		    $this->Cell(195, 0, utf8_decode(''), 0);
      		$this->Cell(0, 28, utf8_decode('Oficina de promoción de Arte,'), 0);
		    $this->Ln(1);
		    $this->Cell(195, 0, utf8_decode(''), 0);
      		$this->Cell(180, 39, utf8_decode('Cultura, Deporte y Recreación'), 0);
      		$this->Ln(1);
      		$this->SetFont('Arial', 'B', 30);
      		$this->Cell(0, 90,utf8_decode('CONSTANCIA'),0,1,'C' );
      		$this->Ln(1);
      		$this->SetFont('Arial', 'B', 16);
    		//$this->SetFillColor(154,0,0);
    		$this->Ln(-40);
      		$this->Cell(0, 10,utf8_decode('Otorgado a:'),0,1,'C' );
      		$this->Line(200, 36, 200,20);
			/*$this->SetTextColor(0, 153, 153);
		    $this->SetFont('Arial', '', 8);
		    $this->Cell(140, 10, 'DISTRIBUIDOR', 0);
		    $this->Ln(5);
		    $this->SetFont('Arial', 'B', 15);
		    $this->Cell(140, 10, 'COMPUPLAZA',0 );
		    $this->SetFont('Arial', '', 10);
		    $this->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
		    $this->Ln(5);
		    $this->SetFont('Arial', 'I', 10);
		    $this->Cell(140, 10, 'Calle: Jose Olaya # 104, La Tomilla, CAYMA.', 0);*/	
		}
		function PDF($orientation='P', $unit='mm', $size='A4',$n1,$n2,$n3)
		{
			// Call parent constructor
			$this->FPDF($orientation,$unit,$size);
			$this->d1 = $n1;
			$this->d2 = $n2;
			$this->d3 = $n3;
			// Initialization
			$this->B = 0;
			$this->I = 0;
			$this->U = 0;
			$this->HREF = '';
			$this->mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		}
		function Footer()
		{
			$this->SetY(-15);
      		$this->Cell(24, -15,utf8_decode(''),0 );
      		$this->SetFont('Arial', 'B', 14);
      		$this->Cell(30, -15,utf8_decode($this->d1),0 );
      		$this->SetFont('Arial', '', 14);
      		$this->Ln(1);
      		$this->Cell(34, -5,utf8_decode(''),0 );
        	$this->Cell(30, -5,utf8_decode('Director de la DUDE'),0 );
      		$this->SetLineWidth(0.8);
        	$this->Line(40, 183, 100,183);

        	$this->SetY(-25);
      		$this->SetFont('Arial', 'B', 14);
      		$this->Cell(0, -15,utf8_decode($this->d2),0 ,1,'C');
      		$this->SetFont('Arial', '', 14);
      		$this->Ln(1);
        	$this->Cell(0, 23,utf8_decode('Vicerrectora Académica'),0 ,1,'C');
      		$this->SetLineWidth(0.8);
        	$this->Line(122, 173, 182,173);

        	$this->SetY(-15);
        	$this->Cell(183, -15,utf8_decode(''),0 );
      		$this->SetFont('Arial', 'B', 14);
      		$this->Cell(30, -15,utf8_decode($this->d3),0 );
      		$this->SetFont('Arial', '', 14);
      		$this->Ln(1);
      		$this->Cell(200, -5,utf8_decode(''),0 );
        	$this->Cell(30, -5,utf8_decode('Jefa de la OPACDR'),0 );
      		$this->SetLineWidth(0.8);
        	$this->Line(210, 183, 270,183);

        	$this->Ln(-65);
        	$this->Cell(22);
	        $this->Cell(0,25,'Arequipa, '.getdate()['mday'].' '.$this->mes[getdate()['mon']].' del '.getdate()['year'],0,1,'L');
        	/*$this->Cell(0, -15,utf8_decode('Berly Zuñiga Carpio'),0,1,'C' );
        	$this->Cell(0, 30,utf8_decode('Director'),0,1,'C' );
        	$this->Cell(0, -15,utf8_decode('Berly Zuñiga Carpio'),0,1,'C' );
        	$this->Cell(0, 30,utf8_decode('Director'),0,1,'C' );
			/*
			$this->SetTextColor(0, 153, 153);
		    // Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');*/
		}
		function WriteHTML($html)
		{
			// HTML parser
			$html = str_replace("\n",' ',$html);
			$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
			foreach($a as $i=>$e)
			{
				if($i%2==0)
				{
					// Text
					if($this->HREF)
						$this->PutLink($this->HREF,$e);
					else
						$this->Write(5,$e);
				}
				else
				{
					// Tag
					if($e[0]=='/')
						$this->CloseTag(strtoupper(substr($e,1)));
					else
					{
						// Extract attributes
						$a2 = explode(' ',$e);
						$tag = strtoupper(array_shift($a2));
						$attr = array();
						foreach($a2 as $v)
						{
							if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
								$attr[strtoupper($a3[1])] = $a3[2];
						}
						$this->OpenTag($tag,$attr);
					}
				}
			}
		}	
		function OpenTag($tag, $attr)
		{
			// Opening tag
			if($tag=='B' || $tag=='I' || $tag=='U')
				$this->SetStyle($tag,true);
			if($tag=='A')
				$this->HREF = $attr['HREF'];
			if($tag=='BR')
				$this->Ln(5);
		}

		function CloseTag($tag)
		{
			// Closing tag
			if($tag=='B' || $tag=='I' || $tag=='U')
				$this->SetStyle($tag,false);
			if($tag=='A')
				$this->HREF = '';
		}

		function SetStyle($tag, $enable)
		{
			// Modify style and select corresponding font
			$this->$tag += ($enable ? 1 : -1);
			$style = '';
			foreach(array('B', 'I', 'U') as $s)
			{
				if($this->$s>0)
					$style .= $s;
			}
			$this->SetFont('',$style);
		}

		function PutLink($URL, $txt)
		{
			// Put a hyperlink
			$this->SetTextColor(0,0,255);
			$this->SetStyle('U',true);
			$this->Write(5,$txt,$URL);
			$this->SetStyle('U',false);
			$this->SetTextColor(0);
		}
	}
?>
