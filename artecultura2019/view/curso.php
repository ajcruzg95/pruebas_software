<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    
    
    <script>
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR CURSO");
                $("#cabecera").text("MODIFICAR CURSO");
                
                $("#botonGuardar").attr("name", "modificar");

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
        }
        function eliminar(data_id,nombre){
            //data_id = this.value;
                r = confirm("Seguro que desea eliminar el curso " +nombre);
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
                           window.location.replace('../controller/ControladorCurso.php');
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

            $var = "Curso";
            $("#primero").text("GESTIÓN DE CURSO");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR CURSO");
                $("#cabecera").text("REGISTRAR CURSO");
                $("#tabla").hide();
                $("#botonGuardar").attr("name", "guardar");
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
                <a id="primero" href='../controller/ControladorCurso.php'></a>
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
                    <form action="../controller/ControladorCurso.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Curso</label>
                            <input class='form-control' id='idTaller' type='text' name='idCurso' aria-describedby='nameHelp' placeholder='Id del curso'>

                        </div>   
                        <div class="form-group">
                            <label for="nombreTaller">Nombre Curso</label>
                            <input class='form-control' id='nombreTaller' type='text' name='nombreCurso' aria-describedby='nameHelp' placeholder='Nombre del curso'>

                        </div>      
                        <div class="form-group">
                            <label for="creditoTaller">Creditos </label>
                            <input class="form-control" id="creditoTaller" val="" type="text" name='creditoCurso' aria-describedby="nameHelp" placeholder="Creditos">

                        </div>  


                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" name="guardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorCurso.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Cursos</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nombre</th>
                                <th>Créditos</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($cursos, true);
                            $i=1;
                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $i </td>
                            <td> $valor[CursoNombre] </td>
                            <td> $valor[CursoCreditos] </td>
                             
                            <td><button onclick='editar($valor[IdCurso])' style=' padding: 5px 25px;padding-left: 10px;' class=' col-md-2 botonModificar btn btn-outline-primary btn-block' ><span class='fa fa-pencil fa-2x'></span></a></td>
                            <td><button onclick='eliminar($valor[IdCurso],\" $valor[CursoNombre] \")' style=' padding: 5px 25px;padding-left: 10px;' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' ><span class='fa fa-trash fa-2x'></span></a></td>
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
