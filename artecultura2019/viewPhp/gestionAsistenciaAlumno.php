<?php

if(isset($_SESSION['IdDocente'])){
    
    include 'indexDocente.php';     
    include '../view/asistenciaDocente.php';
}else{
    include 'index.php';
    include '../view/asistenciaAlumno.php';
}
//incluir vista de asistencia solamente

include 'footDocente.php';