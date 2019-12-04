  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
        function activar(data_id,nombre){
            r = confirm("Esta seguro que desea ACTIVAR la matricula del alumno " + nombre);
            if (r == true) {
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAbandonados.php',
                    data: {
                        id: data_id,
                        modo: 2
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorAbandonados.php');
                    }
                });
            }
        }
        function eliminar(data_id,nombre){
            r = confirm("Esta seguro que desea ELIMINAR la matricula del alumno " + nombre);
            if (r == true) {
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAbandonados.php',
                    data: {
                        id: data_id,
                        modo: 1
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorAbandonados.php');
                    }
                });
            }
        }
        

        function limpiar() {
            $("#idTaller").val("");
            $("#nombreTaller").val("");
            $("#creditoTaller").val("");
        }

        $(document).ready(function () {


            $("#primero").text("GESTIÓN DE ABANDONOS");
            $("#campoId").hide();
            $("#registro").hide();
            
        });

    </script>
</head>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<div class='content-wrapper'>
    <div class='container-fluid'>
        <!-- Breadcrumbs-->
        <ol class='breadcrumb'>
            <li class='breadcrumb-item'>
                <a id="primero" href='../controller/Controladorabandonados.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->

        <!-- Area para Registrare-->
        
        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header'>
                <i class='fa fa-table'></i> Lista de Abandonos</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>NombreGrupo</th>
                                <th>CodigoGrupo</th>
                                <th>CUI Alumno</th>
                                <th>Nombre Alumno</th>
                                <!--<th> Eliminar</th>-->
                                <!--<th> Activar</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($info, true);

                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $valor[IdAlumnoGrupo]</td>
                            <td> $valor[CursoNombre] ($valor[GrupoNombre]) </td>
                            <td>$valor[GrupoCodigo]</td>
                            <td>$valor[AlumnoCodigo]</td>
                             <td>$valor[AlumnoNombre] $valor[AlumnoApellido]</td>
                            <!--
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='eliminar($valor[IdAlumnoGrupo], \"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' ><span class='fa fa-trash fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='activar($valor[IdAlumnoGrupo],\"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' ><span class='fa fa-level-up fa-2x'></a></td>-->
                            </tr>

                            ";
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
