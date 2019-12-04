  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    
    <script>
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR INSTRUCTOR");
                $("#cabecera").text("MODIFICAR INSTRUCTOR ");


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
                        //alert(data);
                        var json = $.parseJSON(data);
                        $('#IdDocente').val(json.IdDocente);
                        $('#DocenteNombre').val(json.DocenteNombre);
                        $('#DocenteApellido').val(json.DocenteApellido);
                        $('#DocenteCodigo').val(json.DocenteCodigo);
                        $('#DocenteDNI').val(json.DocenteDNI);
                        //$("#DocenteContra").attr("type", "text");
                        $('#DocenteContra').val(json.DoncenteContra);
                        $('#DocenteContraConf').val(json.DoncenteContra);
                        $('#DocenteCorreo').val(json.DocenteCorreo);
                        $('#DocenteCelular').val(json.DocenteCelular);
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
                            window.location.replace('../controller/ControladorDocente.php');
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

            $var = "Docente";
            $("#primero").text("GESTIÓN DE INSTRUCTOR");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR INSTRUCTOR");
                $("#cabecera").text("REGISTRAR INSTRUCTOR");
                $("#tabla").hide();
            });
           $("#DocenteNombre").keyup(function(){
                  cod=  $("#DocenteNombre").val();
                  $("#DocenteNombre").val(cod.toUpperCase());
            }); 
           $("#DocenteApellido").keyup(function(){
                  cod=  $("#DocenteApellido").val();
                  $("#DocenteApellido").val(cod.toUpperCase());
            }); 
            
            $("#DocenteDNI").keyup(function(){
                cod =$("#DocenteCodigo").val();
                dni=  $("#DocenteDNI").val();
                if(cod!="" && dni!="")
                    $("#DocenteContra").val(cod+dni);
                else
                    $("#DocenteContra").val('');

            });
             $("#DocenteCodigo").keyup(function(){
                cod =$("#DocenteCodigo").val();
                dni=  $("#DocenteDNI").val();
                if(cod!="" && dni!="")
                    $("#DocenteContra").val(cod+dni);
                else
                    $("#DocenteContra").val('');

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
                <a id="primero" href='../controller/ControladorDocente.php'></a>
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
                    <form action="../controller/ControladorDocente.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Instructor</label>
                            <input class='form-control' id='IdDocente' type='text' name='IdDocente' aria-describedby='nameHelp' placeholder='Id del docente'>

                        </div>   


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Nombre Instructor</label>
                                    <input class='form-control' id='DocenteNombre' type='text' name='DocenteNombre' aria-describedby='nameHelp' placeholder='Nombre del Instructor'>
                                </div>
                                <div class="col-md-6">
                                    <label for="creditoTaller">Apellido Instructor</label>
                                    <input class="form-control" id="DocenteApellido" val="" type="text" name='DocenteApellido' aria-describedby="nameHelp" placeholder="Apellido Instructor">

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Codigo Instructor</label>
                                    <input class='form-control' id='DocenteCodigo' type='number' name='DocenteCodigo' required aria-describedby='nameHelp'  placeholder='Codigo del Instructor'>

                                </div>
                                <div class="col-md-6">
                                    <label for="creditoTaller">DNI Instructor</label>
                                    <input class="form-control" id="DocenteDNI" val="" type="number" name='DocenteDNI' required aria-describedby="nameHelp"  placeholder="DNI Instructor">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="DocenteContra">Contraseña</label>
                                    <input class="form-control"  id="DocenteContra" name="DocenteContra" required readonly  type="text" placeholder="Contraseña">
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="creditoTaller">Correo Instructor</label>
                                    <input class="form-control" id="DocenteCorreo" val="" type="text" name='DocenteCorreo' aria-describedby="nameHelp" placeholder="Correo Instructor">
                                </div>
                                <div class="col-md-6">
                                    <label for="creditoTaller">Celular Instructor</label>
                                    <input class="form-control" id="DocenteCelular" val="" type="text" name='DocenteCelular' aria-describedby="nameHelp" placeholder="Celular Instructor">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorDocente.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Instructores</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Codigo</th>
                                <th>DNI</th>
                                <th>Correo</th>
                                <th>Celular</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($docentes, true);
                            $i=1;
                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $i </td>
                            <td> $valor[DocenteNombre] </td>
                            <td> $valor[DocenteApellido] </td>
                            <td> $valor[DocenteCodigo]</td>
                            <td> $valor[DocenteDNI]</td>
                            <td> $valor[DocenteCorreo]</td>
                            <td> $valor[DocenteCelular]</td>
                             
                            <td><button onclick='editar( $valor[IdDocente])'  style=' padding: 5px 25px;padding-left: 10px;' class=' col-md-2 botonModificar btn btn-outline-primary btn-block'   ><span class='fa fa-pencil fa-2x'></span></a></td>
                            <td><button onclick='eliminar( $valor[IdDocente],\"$valor[DocenteNombre]  $valor[DocenteApellido]\")'  style=' padding: 5px 25px;padding-left: 10px;' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' ><span class='fa fa-trash fa-2x'></span></a></td>
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
