<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '..\PHPExcel\IOFactory.php';
 $archivo='..\libros\alumnos.xls';
 
 //$reader= PHPExcel_IOFactory::createReader('Excel5');
 $objPhpexcel=PHPExcel_IOFactory::load($archivo);
 
 $objPhpexcel->setActiveSheetIndex(0);
 $ultimaFila=$objPhpexcel->getActiveSheet()->getHighestDataRow('A');
 $inicioFila=11;
 for ($row=$inicioFila;$row<$ultimaFila;$row++){
     $cui= $objPhpexcel->getActiveSheet()->getCellByColumnAndRow(1, $row);
     $nombreCompleto= $objPhpexcel->getActiveSheet()->getCellByColumnAndRow(2,$row);
     $indiceSlash= strrpos($nombreCompleto, "/");
     $indiceEspacio=strrpos($nombreCompleto," " );
     $indiceComa=strrpos($nombreCompleto,"," );
     $apellidopat= substr($nombreCompleto,0,$indiceSlash);
     $apellidomat = substr($nombreCompleto,$indiceSlash+1,$indiceComa-$indiceSlash-1);
     $nombre= substr($nombreCompleto, $indiceComa+2);
     echo "pat=".$apellidopat." ";
     echo "mat=".$apellidomat." ";
     echo "nom=".$nombre.        "<br>";
     
     
     //$nombre= substr($nombreCompleto, 0, $indiceSlash);
 }
 
 
 //$objPhpexcel->getActiveSheet()->SetCellValue('A2','NUEVOS DULCES');
 //echo $objPhpexcel->getActiveSheet()->getCell('A2');
 //$objPhpexcel->getActiveSheet()->SetCellValue('A1','NUEVOS DULCES');
 //echo $objPhpexcel->getActiveSheet()->getCell('A1');
 //echo $objPHPExcel->getActiveSheetIndex();
// header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//header("Content-Disposition: attachment; filename=\"results.xls\"");
//header("Cache-Control: max-age=0");
// $writer = PHPExcel_IOFactory::createWriter($objPhpexcel,'Excel5');
 //$writer->save("php://output");
 
 
         

