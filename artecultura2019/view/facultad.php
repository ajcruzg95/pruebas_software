  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    
    <script>
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR FACULTAD ");
                $("#cabecera").text("MODIFICAR FACULTAD ");
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
                        $('#IdFacultad').val(json.IdFacultad);
                        $('#FacultadNombre').val(json.FacultadNombre);
                    }
                });
        }
        function eliminar(data_id,nombre){
                r = confirm("Seguro que desea eliminar la facultad " + nombre);
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
                            window.location.replace('../controller/ControladorFacultad.php');
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

            $var = "Facultad";
            $("#primero").text("GESTIÓN DE FACULTAD");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR FACULTAD");
                $("#cabecera").text("REGISTRAR FACULTAD");
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
                <a id="primero" href='../controller/ControladorFacultad.php'></a>
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
                    <form action="../controller/ControladorFacultad.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Facultad</label>
                            <input class='form-control' id='IdFacultad' type='text' name='IdFacultad' aria-describedby='nameHelp' placeholder='Id de Facultad'>
                        </div> 
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreGrupo">Nombre de Facultad</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='FacultadNombre' type='text' name='FacultadNombre' aria-describedby='nameHelp' required placeholder='Nombre de Facultad'>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorFacultad.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Facultades</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre Facultad</th>
                                <th>Escuelas</th>
                                <th> Editar</th>
                                <th> Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $arrayFacultad = json_decode($facultades, true);

                            $i=1;
                            foreach ($arrayFacultad as &$valor) {
                                echo "<tr>
                            <td> $i </td>
                            <td> $valor[FacultadNombre] </td>
                            <td>   
                            <form action='../controller/ControladorEscuela.php' method='POST'>
                            <input type='hidden' name='IdFacultad' value=$valor[IdFacultad]>

                            <button type='submit' class=' col-md-9 botonHorario btn btn-outline-secondary btn-block'
                            value= $valor[IdFacultad]>Escuelas</a>
                            </form>    
                            </td>
                                <td><button onclick='editar( $valor[IdFacultad])' style=' padding: 5px 25px;padding-left: 10px;'  type='submit' class=' col-md-4 botonModificar btn btn-outline-primary btn-block'
                            ><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button onclick='eliminar( $valor[IdFacultad] ,\"$valor[FacultadNombre]\")' style=' padding: 5px 25px;padding-left: 10px;'  type='submit' class=' col-md-4 botonEliminar btn btn-outline-secondary btn-block'
                            ><span class='fa fa-trash fa-2x'></a></td>
                                
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
