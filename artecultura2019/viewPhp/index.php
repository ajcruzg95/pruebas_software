<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SISTEMA ARTUNSA</title>
        <!-- Bootstrap core CSS-->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
		<link href="../vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin.css" rel="stylesheet">


        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="../js/sb-admin-datatables.min.js"></script>
        <script src="../js/sb-admin-charts.min.js"></script>

    </head>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <!-- Navigation-->
        <!--style="background-color: #64001D"-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top"   id="mainNav" >
            <center> <a class="navbar-brand" href="#" style="padding-left: 250px; font-size:x-large" > SISTEMA ADMINISTRATIVO ARTUNSA </a></center>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav navbar-sidenav" style="
                    margin-top: 61px;
                    " id="exampleAccordion">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="../viewPhp/gestionHome.php">
                            <i class="fa fa-fw fa-home"></i>
                            <span class="nav-link-text">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                            <i class="fa fa-cogs"> </i>
                            <span class="nav-link-text">Gestión</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseComponents">
                            <!-- <li>
                                <a href="../controller/ControladorUsuario.php"><span class="fa fa-users"></span>   Usuarios</a>
                            </li>
                            -->
                            <li>
                                <a href="../controller/ControladorFacultad.php"><span class="fa fa-building-o"></span>   Facultad</a>
                            </li>
                            <li>
                                <a href="../controller/ControladorAlumno.php"><span class="fa fa-user-plus"></span>   Alumno</a>
                            </li>
                            <li>
                                <a href="../controller/ControladorCurso.php"><span class="fa fa-edit"></span> Taller</a>
                            </li>
                            <li>
                                <a href="../controller/ControladorDocente.php"><span class="fa fa-user-plus"></span> Instructor</a>
                            </li>
                            <li>
                                <a href="../controller/ControladorLugar.php"><span class="fa fa-object-ungroup"></span> Ambiente</a>
                            </li>

                            <li>
                                <a href="../controller/ControladorGrupo.php"><span class="fa fa-object-group"></span>  Grupo Taller</a>
                            </li>
                            <!--<li>
                                <a href="../controller/ControladorDia.php"><span class="fa fa-calendar-plus-o"></span> Día</a>
                            </li>-->
                        </ul>
                    </li>

                    
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="../controller/ControladorAlumnoPrematricula.php">
                            <i class="fa fa-address-card"> </i>
                            <span class="nav-link-text">Pre Matricula</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="../controller/ControladorAlumnoGrupo.php">
                            <i class="fa fa-address-card"> </i>
                            <span class="nav-link-text">Matricula</span>
                        </a>
                    </li>
                    
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents10" data-parent="#exampleAccordion">
                            <i class="fa fa-university"> </i>
                            <span class="nav-link-text">Condicion Matriculados</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseComponents10">
                            <li>
                                <a href="../controller/ControladorAprobados.php"><span class="fa fa-star"></span>   Aprobados</a>
                            </li>
                             <li>
                                <a href="../controller/ControladorRetirados.php"><span class="fa fa-star-half-o"></span>   Retirados</a>
                            </li>
                            <li>
                                <a href="../controller/ControladorAbandonados.php"><span class="fa fa-star-o"></span>   Abandonos</a>
                            </li>
  

                            </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="../controller/ControladorCertificacionAlumno.php">
                            <i class="fa fa-mortar-board"> </i>
                            <span class="nav-link-text">Certificación</span>
                        </a>
                    </li>		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
                            <i class="fa fa-calendar-check-o"> </i>
                            <span class="nav-link-text">Asistencia</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseComponents2">
                            <li>
                                <a href="../controller/ControladorAsistencia.php">  <span class="fa fa-list-ol"></span> Por Taller</a>
                            </li>
                            <li>
                                 <a href="../controller/ControladorAsistenciaAlumno.php"><span class="fa fa-list-ol"></span> Por Alumno</a>
                            </li>
                        </ul>
                    </li>
                    <!--
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                        <a class="nav-link" href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="nav-link-text">Horario</span>
                        </a>
                    </li>
                    



                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-file"></i>
                            <span class="nav-link-text">Reporte</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseMulti1">
                            <li>
                                <a href="../controller/ControladorParteDiario.php">Parte Diarios</a>
                            </li>
                            <li>
                                <a href="#">Asistencia Alumnos</a>
                            </li>

                        </ul>
                    </li>
                    -->
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                        <a class="nav-link" href="../controller/ControladorSede.php">
                            <i class="fa fa-wrench"></i>
                            <span class="nav-link-text">Configuración</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal" >
                            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
    </body>
    <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Realmente desea abandonar ?</h5>
                            <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>×</span>
                            </button>
                        </div>   
                        <div class='modal-body'>Seleccione Cerrar Sesión para finalizar su sesion</div>
                        <div class='modal-footer'>
                            <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancelar</button>
                            <a class='btn btn-primary' href='../controller/ControladorLogout.php'>Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
    </div>

</html>