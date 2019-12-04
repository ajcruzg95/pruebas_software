<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR ALUMNO");
                $("#cabecera").text("MODIFICAR ALUMNO ");
   
                //alert("Esta seguro que desea modificar " +data_id);
                $("#registro").show();
                $("#tabla").hide();

                $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        id: data_id,
                        modo: 1
                    },
                    success: function (data) {
                        var names = data;
                        var json = $.parseJSON(data);
                        $('#IdAlumno').val(json.IdAlumno);
                        $('#IdEscuela1').val(json.IdEscuela1);
                        $('#AlumnoNombre').val(json.AlumnoNombre);
                        $("#AlumnoApellido").val(json.AlumnoApellido);
                        $('#AlumnoCodigo').val(json.AlumnoCodigo);
                        $('#AlumnoCorreo').val(json.AlumnoCorreo);
                        $('#AlumnoCelular').val(json.AlumnoCelular);

                    }
                });
        }
        function eliminar(data_id,nombre){
            r = confirm("Seguro que desea eliminar a " + nombre);
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
                            window.location.replace('../controller/ControladorAlumno.php');
                        }
                    });
                }
        }
        function limpiar() {
            $("#IdAlumno").val("");
            $("#AlumnoNombre").val("");
            $("#AlumnoApellido").val("");
            $("#AlumnoCodigo").val("");
            $("#AlumnoCorreo").val("");
            $("#AlumnoCelular").val("");
        }
        $(document).ready(function () {
            limpiar();
            $var = "Alumno";
            $("#primero").text("GESTIÓN DE ALUMNO");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR ALUMNO");
                $("#cabecera").text("REGISTRAR ALUMNO");
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
                <a id="primero" href='../controller/ControladorAlumno.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->


        <div class="form-group">
            <div class="form-row">
                <div class="col-md-2">
                    <a class="btn btn-primary btn-block" id="botonAgregar" href="#">AGREGAR</a>  
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary btn-block" id="botonAgregarBloque" href="../viewPhp/gestionCargaAlumno.php">AGREGAR POR BLOQUE</a>  
                </div>
            </div>
            
        </div>
        <!-- Area para Registrare-->
        <div class="container" id="registro">
            <div class="card card-register mx-auto mt-5">
                <div id="cabecera" class="card-header"></div>
                <div class="card-body">
                    <form action="../controller/ControladorAlumno.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Alumno</label>
                            <input class='form-control' id='IdAlumno' type='text' name='IdAlumno' aria-describedby='nameHelp' placeholder='Id del docente'>

                        </div>   


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Nombre Alumno</label>
                                    <input class='form-control' id='AlumnoNombre' type='text' name='AlumnoNombre' aria-describedby='nameHelp' placeholder='Nombre del Alumno'>
                                </div>
                                <div class="col-md-6">
                                    <label for="creditoTaller">Apellido Alumno</label>
                                    <input class="form-control" id="AlumnoApellido" val="" type="text" name='AlumnoApellido' aria-describedby="nameHelp" placeholder="Apellido del Alumno">

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">CUI Alumno</label>
                                    <input class='form-control' id='AlumnoCodigo' type='text' name='AlumnoCodigo' aria-describedby='nameHelp' placeholder='Codigo del Alumno'>

                                </div>
                                <div class="col-md-6">
                                    <label for="nombreTaller">Escuela Profesional</label>

                                    <select id="IdEscuela1" name="IdEscuela1" class="selectpicker  col-md-10">
                                        <?php
                                       
                                        $arrayEscuela = json_decode($escuelas, true);
                                        foreach ($arrayEscuela as $value) {
                                            echo "<option value=" . $value['IdEscuela'] . ">" . $value['NombreEscuela'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="creditoTaller">Correo Alumno</label>
                                    <input class="form-control" id="AlumnoCorreo" val="" type="text" name='AlumnoCorreo' aria-describedby="nameHelp" placeholder="Correo del Alumno">
                                </div>
                                <div class="col-md-6">
                                    <label for="creditoTaller">Alumno celular</label>
                                    <input class="form-control" id="AlumnoCelular" val="" type="text" name='AlumnoCelular' aria-describedby="nameHelp" placeholder="Celular del Alumno">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorAlumno.php">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <!--<div class='card-header'>
                <i class='fa fa-table'></i> Lista de Talleres
            </div>-->
            <div class='card-body'>
                <form action="../controller/ControladorAlumno.php" method="POST" >
                <div class="form-group">
                    <label for="nombreTaller">Escuelas</label>
                    <select id="IdEscuela" name="IdEscuela">
                        <option value="-1"></option>
                         <?php
                                       
                            $arrayEscuela = json_decode($escuelas, true);
                            foreach ($arrayEscuela as $value) {
                               echo "<option value=" . $value['IdEscuela'] . ">" . $value['NombreEscuela'] . "</option>";
                            }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary listarAlumnos">LISTAR</button>
                </div>
                </form>
            </div>
            
            <div class='card-header'>
                <i class='fa fa-table'></i> Lista de Alumnos</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>CUI</th>
                                <th>Escuela</th>
                                <th>Nombre Completo</th>
                                <!--<th>Apellido</th>!-->

                                <th>Correo</th>
                                <th>Celular</th>
                                <th>Contacto</th>
                                <th>Cel Contaco</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //ob_end_flush();
                            //ob_start();
                            //set_time_limit(0);
                            //error_reporting(0);

                            $array = json_decode($alumnos, true);
                            $i=1;
                            foreach ($array as $valor) {
                                echo "<tr>
                            <td> $i  </td>
                            <td> $valor[AlumnoCodigo]  </td>
                            <td> $valor[NombreEscuela] </td>
                            <td> $valor[AlumnoApellido] $valor[AlumnoNombre] </td>
                            <td> $valor[AlumnoCorreo] </td>
                            <td> $valor[AlumnoCelular] </td>
                            <td> $valor[AlumnoPersonaEmergeciaNombre] </td>
                            <td> $valor[AlumnoPersonaEmergenciaCelular] </td>
                                
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='editar($valor[IdAlumno])' class=' col-md-2 botonModificar  btn btn-outline-primary btn-block' value= $valor[IdAlumno] ><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='eliminar($valor[IdAlumno], \"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' nombre=' $valor[AlumnoNombre]  $valor[AlumnoApellido]' value= $valor[IdAlumno] ><span class='fa fa-trash fa-2x'></a></td>
                            </tr>";
                                $i++;
                              //  ob_flush();
                            //    flush();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
