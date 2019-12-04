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

            $var = "Sede";
            $("#primero").text("GESTIÓN DE SEDES");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR SEDE");
                $("#cabecera").text("REGISTRAR SEDE");
                $("#tabla").hide();
            });

            $(".botonModificar").click(function () {
                $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR SEDE");
                $("#cabecera").text("MODIFICAR SEDE ");
                data_id = this.value;
                //alert(data_id);
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
                        
                        var json = $.parseJSON(data);
                        
                        $('#IdSede').val(json.IdSede);
                        $('#SedeNombre').val(json.SedeNombre);

                    }
                });
            });
            $(".botonEliminar").click(function () {
                data_id = this.value;
                r = confirm("Seguro que desea eliminar sede " + $(this).attr("nombre"));
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
                            window.location.replace('../controller/ControladorSede.php');
                        }
                    });
                }
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
                <a id="primero" href='../controller/ControladorSede.php'></a>
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
                    <form action="../controller/ControladorSede.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Taller</label>
                            <input class='form-control' id='IdSede' type='text' name='IdSede' aria-describedby='nameHelp' placeholder='Nombre del curso'>

                        </div> 

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreGrupo">Nombre de la Sede</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='SedeNombre' type='text' name='SedeNombre' aria-describedby='nameHelp' placeholder='Nombre de la Sede'>
                                </div>
                            </div>   
                        </div>
                        
                        
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorSede.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Sedes</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre Sede</th>
                                <th> Activar</th>
                                <th> Periodo</th>
                                <th> Editar</th>
                                <th> Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $arraySede = json_decode($sedes, true);
                            $i=1;
                            foreach ($arraySede as &$valor) {
                                
                                if($valor['SedeActivo']){
                                    echo "<tr class=table-info>";
                                }else{
                                    echo "<tr>";
                                }
                            echo "<td>" . ($valor['IdSede']) . "</td>
                            <td>" . ($valor['SedeNombre']) . "</td>
                            <td>   
                            <form action='../controller/ControladorSede.php' method='POST'>
                            <input type='hidden' name='activar' value=" . $valor['IdSede'] . ">
                               
                            <button type='submit' class=' col-md-9 botonHorario btn btn-outline-secondary btn-block'>Activar</a>
                            </form>    
                            </td>    
                            <td>   
                            <form action='../controller/ControladorPeriodo.php' method='POST'>
                            <input type='hidden' name='IdSede' value=" . $valor['IdSede'] . ">

                            <button  type='submit' class=' col-md-9 botonHorario btn btn-outline-secondary btn-block'
                            value=" . $valor['IdSede'] . ">Periodos</a>
                            </form>    
                            </td>
                                <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonModificar btn btn-outline-primary btn-block'
                            value=" . $valor['IdSede'] . "><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' nombre=" . $valor['SedeNombre'] ." value=" . $valor['IdSede'] . "><span class='fa fa-trash fa-2x'></a></td>
                                
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

