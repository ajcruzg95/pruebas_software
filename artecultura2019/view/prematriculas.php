  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
       function retornarDetalleRetiro(codigoAlumno){
            detalle = "";
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorRetirados.php',
                data: {
                    id: codigoAlumno,
                    modo: 3
                },
                success: function (data) {
                   
                    var json = $.parseJSON(data);
                    if(json.length > 0){
                        detalle ="DETALLE RETIROS\n";
                        for (var valor of json){
                            detalle =detalle+"AÑO "+valor.PeriodoAnio+" -NÚMERO "+valor.PeriodoNumero+"- TALLER "+ valor.CursoNombre+"("+valor.GrupoNombre+")\n";
                        }   
                    }
                    
                }
            });
            return detalle;
        }
        function retornarDetalleAbandono(codigoAlumno){
            detalleAbandono = "";
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorAbandonados.php',
                data: {
                    id: codigoAlumno,
                    modo: 3
                },
                success: function (data) {
                    
                    var json = $.parseJSON(data);
                    if(json.length > 0){
                        detalleAbandono ="DETALLE ABANDONOS\n";
                        for (var valor of json){
                            detalleAbandono =detalleAbandono+"AÑO "+valor.PeriodoAnio+" -NÚMERO "+valor.PeriodoNumero+"- TALLER "+ valor.CursoNombre+"("+valor.GrupoNombre+")\n";
                        }
                    }

                }
            });
            return detalleAbandono;
        }
        
        function validarMatricula(data_id,nombre,ideA){
            $.when(     retornarDetalleRetiro(ideA),
                        retornarDetalleAbandono(ideA)).
            done(function (retiro,abandonos) {
                    //this callback will be fired once all ajax calls have finished.
                r = confirm("Esta seguro que desea Validar la Pre Matricula de " + nombre+"\n"+
                retiro+abandonos);
                if (r == true) {
                    $("#tabla").show();
                    $.ajax({
                        type: 'POST',
                        url: '../controller/Controlador' + $var + '.php',
                        data: {
                            id: data_id,
                            modo: 4
                        },
                        success: function (data) {
                            window.location.replace('../controller/ControladorAlumnoPrematricula.php');
                        }
                    });
                }    
            });
                        
            
        }
        function eliminar(data_id,nombre){
            r = confirm("Esta seguro que desea ELIMINAR la matricula del alumno " + nombre);
            if (r == true) {
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        id: data_id,
                        modo: 2
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorAlumnoPrematricula.php');
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

            $var = "AlumnoPrematricula";
            $("#idCurso").keyup(function () {
                var ide = $("#idCurso").val();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAlumnoPrematricula.php',
                    data: {
                        id: ide,
                        modo: 3 
                    },
                    success: function (data) {
                        var names = data;
                        //console.log(data);
                        var json = $.parseJSON(data);
                        $('#nombreTaller').val(json.CursoNombre + "(" + json.GrupoNombre + ")");
                    }
                });
            });
            $("#idAlumno").keyup(function () {
                var ide = $("#idAlumno").val();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAlumno.php',
                    data: {
                        id: ide,
                        modo: 3
                    },
                    success: function (data) {
                        var names = data;
                        //console.log(data);
                        var json = $.parseJSON(data);
                        //console.log("perro " + json.AlumnoNombre + json.AlumnoApellido);
                        $('#nombreAlumno').val(json.AlumnoNombre + " " + json.AlumnoApellido);

                    }
                });


            });
            $("#primero").text("GESTIÓN DE PRE MATRICULAS");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR PREMATRICULAS" );
                $("#cabecera").text("REGISTRAR PREMATRICULAS" );
                $("#tabla").hide();
            });
            
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
                <a id="primero" href='../controller/ControladorAlumnoPrematricula.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->


        <div class="form-group">
            <div class="form-row">
                <div class="col-md-2">
                  <!--  <a class="btn btn-primary btn-block" id="botonAgregar" href="#">AGREGAR</a>  -->
                </div>
            </div>
        </div>
        <!-- Area para Registrare-->
        

        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header'>
                <i class='fa fa-table'></i> Lista de Pre Matriculas</div>
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
                                <th>Eliminar</th>
                                <th>Matricular </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //session_start();
                            
                            error_reporting(E_ERROR | E_PARSE);
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            $info1=$_SESSION['info'];
                        
                            $array = json_decode($info1, true);
                            $i=1;
                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $i </td>
                            <td> $valor[CursoNombre] ($valor[GrupoNombre]) </td>
                            <td>$valor[GrupoCodigo]</td>
                            <td>$valor[AlumnoCodigo]</td>
                             <td>$valor[AlumnoNombre] $valor[AlumnoApellido]</td>
                            
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='eliminar($valor[IdAlumnoGrupo], \"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdAlumnoGrupo'] . "><span class='fa fa-trash fa-2x'></a></td>
                            
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='validarMatricula($valor[IdAlumnoGrupo],\"$valor[AlumnoNombre] $valor[AlumnoApellido]\",$valor[AlumnoCodigo])' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdAlumnoGrupo'] . "><span class='fa fa-share-square fa-2x'></a></td>
                            
                            
                            </tr>";
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    

