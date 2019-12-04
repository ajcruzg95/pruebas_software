<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR USUARIO");
                $("#cabecera").text("MODIFICAR USUARIO ");
   
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
                        $('#IdUsuario').val(json.IdUsuario);
                        $('#IdTipoUsuario').val(json.IdTipoUsuario);
                        $('#UsuarioNombre').val(json.UsuarioNombre);
                        $("#UsuarioApellido").val(json.UsuarioApellido);
                        $('#UsuarioContrasenia').val(json.UsuarioContrasenia);
                      

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
                            window.location.replace('../controller/ControladorUsuario.php');
                        }
                    });
                }
        }
        function limpiar() {
            $("#IdUsuario").val("");
            $("#IdTipoUsuario").val("");
            $("#UsuarioNombre").val("");
            $("#UsuarioApellido").val("");
            $("#UsuarioContrasenia").val("");
            
        }
        $(document).ready(function () {
            limpiar();
            $var = "USUARIO";
            $("#primero").text("GESTIÓN DE USUARIO");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR USUARIO");
                $("#cabecera").text("REGISTRAR USUARIO");
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
                <a id="primero" href='../controller/ControladorUsuario.php'></a>
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
                    <form action="../controller/ControladorUsuario.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Usuario</label>
                            <input class='form-control' id='IdUsuario' type='text' name='IdUsuario' aria-describedby='nameHelp' placeholder='Id del Usuario'>

                        </div>   
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Tipo Usuario</label>

                                    <select id="IdTipoUsuario" name="IdTipoUsuario" class="selectpicker  col-md-10">
                                        <?php
                                        $arrayEscuela = json_decode($tiposusers, true);
                                        echo $arrayEscuela[0]['IdTipoUsuario'];
                                        
                                        echo json_encode(count($arrayEscuela));
                                        echo "hola perros";
                                        foreach ($arrayEscuela as $value) {
                                            echo "<option value=" . $value['IdTipoUsuario'] . ">" . $value['TipoUsuarioNombre'] . "</option>";
                                            
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div> 
                         <!--
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                        
                                    <label for="creditoTaller">ID Usuario</label>
                                    <input class="form-control" id="IdUsuario" val="" type="text" name='IdUsuario' aria-describedby="nameHelp" placeholder="ID Usuario">
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                        
                                    <label for="creditoTaller">Nombre Usuario</label>
                                    <input class="form-control" id="UsuarioNombre" val="" type="text" name='UsuarioNombre' aria-describedby="nameHelp" placeholder="Nombre Usuario">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Apellido Usuario</label>
                                    <input class='form-control' id='UsuarioApellido' type='text' name='UsuarioApellido' aria-describedby='nameHelp' placeholder='Usuario Apellido'>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nombreTaller">Contraseña</label>
                                    <input class='form-control' id='UsuarioContrasenia' type='password' name='UsuarioContrasenia' aria-describedby='Contraseña Usuario'>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorUsuario.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Usuarios</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>TIPO</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>CONTRASEÑA</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            ob_end_flush();
                            ob_start();
                            set_time_limit(0);
                            error_reporting(0);

                            $array = json_decode($usuarios, true);

                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $valor[IdUsuario]  </td>
                            <td> $valor[TipoUsuarioNombre]  </td>
                            <td> $valor[UsuarioNombre] </td>
                            <td> $valor[UsuarioApellido] </td>
                            <td> $valor[UsuarioContrasenia] </td>
                          
                                
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='editar($valor[IdUsuario])' class=' col-md-2 botonModificar  btn btn-outline-primary btn-block' value= $valor[IdUsuario] ><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='eliminar($valor[IdUsuario], \"$valor[UsuarioNombre] $valor[UsuarioApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' nombre=' $valor[UsuarioNombre]  $valor[UsuarioApellido]' value= $valor[IdUsuario] ><span class='fa fa-trash fa-2x'></a></td>
                            </tr>";
                                ob_flush();
                                flush();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
