  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    
    <script>
        function limpiar() {
            $("#idTaller").val("");
            $("#nombreTaller").val("");
            $("#creditoTaller").val("");
        }
        $(document).ready(function () {

            $var = "MATRICULA " + $var
                    );
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR " + $var);
                $("#cabecera").text("REGISTRAR " + $var);
                $("#tabla").hide();
            });
            $(".botonModificar").click(function () {
                $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR " + $var);
                $("#cabecera").text("MODIFICAR " + $var);
                data_id = this.value;


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
                        $('#idTaller').val(json.IdCurso);
                        $('#nombreTaller').val(json.CursoNombre);
                        $('#creditoTaller').val(json.CursoCreditos);
                    }
                });
            });
            $(".botonEliminar").click(function () {
                data_id = this.value;

                //alert("Esta seguro que desea eliminar " +data_id);
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        id: data_id,
                        modo: 2
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorMatricula.php');
                    }
                    }
                });
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
                <a id="primero" href='../controller/ControladorMatricula.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->


        <div class="form-group">
            <div class="form-row">
                <div class="col-md-2">
                    <a class="btn btn-primary btn-block" id="botonAgregar" href="#">AGREGAR</a>  
                </div>
            </div>
        </div>
        <!-- Area para Registrare-->
        <div class="container" id="registro">
            <div class="card card-register mx-auto mt-5">
                <div id="cabecera" class="card-header"></div>
                <div class="card-body">
                    <form action="../controller/ControladorMatricula.php" method='POST'>

                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Curso</label>
                            <input class='form-control' id='idTaller' type='text' name='idCurso' aria-describedby='nameHelp'  placeholder='Id del curso'>

                        </div>   
                        <div class="form-group">
                            <label for="nombreTaller">Nombre Curso</label>
                            <input class='form-control' id='nombreTaller' type='text' name='nombreCurso' aria-describedby='nameHelp' disabled placeholder='Nombre del curso'>

                        </div>      
                        <div class="form-group">
                            <label for="creditoTaller">Id Alumno</label>
                            <input class="form-control" id="creditoTaller" val="" type="text" name='creditoCurso' aria-describedby="nameHelp" placeholder="Id Alumno">

                        </div>  

                        <div class="form-group">
                            <label for="creditoTaller">Alumnos</label>
                            <input class="form-control" id="creditoTaller" val="" type="text" name='creditoCurso' aria-describedby="nameHelp" disabled placeholder="Nombre Alumno">

                        </div> 


                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">MATRICULA</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorMatricula.php">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header'>
                <i class='fa fa-table'></i>Matricula</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Alumno</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($cursos, true);

                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td>" . ($valor['IdCurso']) . "</td>
                            <td>" . ($valor['CursoNombre']) . "</td>
                            <td>" . ($valor['CursoCreditos']) . "</td>
                             
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonModificar btn btn-outline-primary btn-block' value=" . $valor['IdMatricula'] . "><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdMatricula'] . "><span class='fa fa-trash fa-2x'></a></td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
