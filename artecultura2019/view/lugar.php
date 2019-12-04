<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    
    <script>
        function limpiar() {
            $("#IdLugar").val("");
            $("#LugarNombre").val("");
        }
        $(document).ready(function () {

            $var = "Lugar";
            $("#primero").text("GESTIÓN DE AMBIENTE");
            //$("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR AMBIENTE" );
                $("#cabecera").text("REGISTRAR AMBIENTE ");
                $("#tabla").hide();
            });
            $(".botonModificar").click(function () {
                $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR AMBIENTE" );
                $("#cabecera").text("MODIFICAR AMBIENTE " );
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
                        $('#IdLugar').val(json.IdLugar);
                        $('#LugarNombre').val(json.LugarNombre);
                         
                    }
                });
            });
            $(".botonEliminar").click(function () {
                data_id = this.value;
                r = confirm("Seguro que desea eliminar el ambiente " + $(this).attr("nombre"));
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
                            window.location.replace('../controller/ControladorLugar.php');
                        }
                    });
                }
            });
        });
    </script>
</head>
<div class='content-wrapper'>
    <div class='container-fluid'>
        <!-- Breadcrumbs-->
        <ol class='breadcrumb'>
            <li class='breadcrumb-item'>
                <a id="primero" href='../controller/ControladorLugar.php'></a>
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
                    <form action="../controller/ControladorLugar.php" method='POST' >
                        <div class="form-group" id="campoId">
                            
                            <input class='form-control' id='IdLugar' type='hidden' name='IdLugar' aria-describedby='nameHelp' placeholder='Nombre del Ambiente'>

                        </div>   
                        <div class="form-group">
                            <label for="nombreTaller">Nombre Ambiente</label>
                            <input class='form-control' id='LugarNombre' type='text' name='LugarNombre' aria-describedby='nameHelp' placeholder='Nombre del Ambiente' required>

                        </div>      

                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorLugar.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Ambientes</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($lugares, true);
                            $i=1;
                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td>" . ($i) . "</td>
                            <td>" . ($valor['LugarNombre']) . "</td>
                                                         
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonModificar btn btn-outline-primary btn-block' value=" . $valor['IdLugar'] . "><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' nombre='".  $valor['LugarNombre'] ."' value=" . $valor['IdLugar'] . "><span class='fa fa-trash fa-2x'></a></td>
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
