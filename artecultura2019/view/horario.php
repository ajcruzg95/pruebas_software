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
        function validateHora() {
            alert("hola");
            var h1= $("#hora1").val();
            var m1=$("#minuto1").val();
            var h2=$("#hora2").val();
            var m2=$("#minuto2").val();

            if (h1 == 0 || m1 == 0 || h2 == 0 || m2 == 0) {
                alert("ingresa horarios por favor!");
                return false;
            }
            else
                document.form.submit();
        }
        $(document).ready(function () {


            $var = "Horario";
            $("#primero").text("GESTIÓN DE HORARIO");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR HORARIO");
                $("#cabecera").text("REGISTRAR HORARIO");
                $("#tabla").hide();

            });
            $("#hora2").attr('disabled', 'disabled');
            $("#minuto2").attr('disabled', 'disabled');
           
            $("#hora1").change(function(){
                console.log("holan");
                $("#hora2").removeAttr('disabled');
                var min = $("#hora1").val();
                console.log("hola"+min);
                $("#hora2").html("");
                for ( var i = min; i <= 20; i++) {
                    if (i > 9) {
                        var string ="<option value = " + i + ">" + i + "</option>";
                        $("#hora2").append(string);
                    } else {
                        var string ="<option value =" +i + ">" +i + "</option>"
                        $("#hora2").append(string);
                    }
                }

            });
            $("#hora2").change(function(){
                $("#hora2").removeAttr('disabled');
                var min = $("#hora1").val();
                $("#minuto2").html("");
                for ( var i = 0; i <= 59; i++) {
                    if (i > 9) {
                        var string ="<option value = " + i + ">" + i + "</option>";
                        $("#minuto2").append(string);
                    } else {
                        var string ="<option value = 0" +i + ">0" +i + "</option>"
                        $("#minuto2").append(string);
                    }
                }

            });
            $("#minuto1").change(function(){
                console.log("holan");
                $("#minuto2").removeAttr('disabled');
                var min = $("#minuto1").val();
                var hora1 = $("#hora1").val();
                var hora2 = $("#hora2").val();
                console.log("hola"+min);
                $("#mimuto2").html("");
                if(hora1==hora2){
                    for ( var i = min; i <= 59; i++) {
                        if (i > 9) {
                            var string ="<option value = " + i + ">" + i + "</option>";
                            $("#minuto2").append(string);
                        } else {
                            var string ="<option value = 0" +i + ">0" +i + "</option>"
                            $("#minuto2").append(string);
                        }
                    }
                }else{
                }

            });
            $(".botonModificar").click(function () {
                $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR HORARIO" );
                $("#cabecera").text("MODIFICAR HORARIO" );
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
                        $('#IdHorario').val(json.IdHorario);
                        $('#IdGrupo').val(json.IdGrupo);
                        $('#IdLugar').val(json.IdLugar);
                        $('#IdDia').val(json.IdDia);
                        var hora1 = json.HorarioEntrada.substring(11, 13);
                        var minuto1 = json.HorarioEntrada.substring(14, 16);

                        if (minuto1.length === 1) {
                            minuto1 = "0" + minuto1;
                        }

                        $('#hora1').val(hora1);
                        $('#minuto1').val(minuto1);

                        var hora2 = json.HorarioSalida.substring(11, 13);
                        var minuto2 = json.HorarioSalida.substring(14, 16);


                        if (minuto2.length === 1) {
                            minuto2 = "0" + minuto2;
                        }
                        $('#hora2').val(hora2);
                        $('#minuto2').val(minuto2);
                    }
                });
            });
            $(".botonEliminar").click(function () {
                data_id = this.value;

                confirm("Esta seguro que desea eliminar " + data_id);
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        id: data_id,
                        modo: 2
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorHorario.php');
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
                <a id="primero" href='../controller/ControladorHorario.php'></a>
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
                    <form action="../controller/ControladorHorario.php" method='POST' >
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Horario</label>
                            <input class='form-control' id='IdHorario' type='text' name='IdHorario' aria-describedby='nameHelp' placeholder='Nombre del curso'>

                        </div>   

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="IdLugar">Lugar</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="IdLugar" name="IdLugar" class="selectpicker col-md-10">
                                        <?php
                                        $arrayLugar = json_decode($lugares, true);
                                        foreach ($arrayLugar as $value) {
                                            echo "<option value=" . $value['IdLugar'] . ">" . $value['LugarNombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="IdLugar">Dia</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="IdDia" name="IdDia" class="selectpicker col-md-10">
                                        <?php
                                        $arrayDia = json_decode($dias, true);
                                        foreach ($arrayDia as $value) {
                                            echo "<option value=" . $value['IdDia'] . ">" . $value['DiaDescripcion'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Horario Entrada</label>
                                </div>
                                <div class="col-md-2">
                                    <select id="hora1" name="hora1" class="selectpicker col-md-10" required>
                                        <?php
                                            echo "<option value=0> </option>";
                                        for ($i = 7; $i <= 20; $i++) {
                                            if ($i > 9) {
                                                echo "<option value = " . $i . ">" . $i . "</option>";
                                            } else {
                                                echo "<option value = 0" . $i . ">0" . $i . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                :
                                <div class="col-md-2">
                                    <select id="minuto1" name="minuto1" class="selectpicker col-md-10" required>
                                        <?php
                                            echo "<option value=0> </option>";
                                        for ($i = 0; $i <= 59; $i++) {
                                            if ($i > 9) {
                                                echo "<option value = " . $i . ">" . $i . "</option>";
                                            } else {
                                                echo "<option value = 0" . $i . ">0" . $i . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Horario Salida</label>
                                </div>
                                <div class="col-md-2">
                                    <select id="hora2" name="hora2" class="selectpicker col-md-10" required>
                                        <?php
                                         echo "<option value=0> </option>";
                                        for ($i = 7; $i <= 20; $i++) {
                                            if ($i > 9) {
                                                echo "<option value = " . $i . ">" . $i . "</option>";
                                            } else {
                                                echo "<option value = 0" . $i . ">0" . $i . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                :
                                <div class="col-md-2">
                                    <select id="minuto2" name="minuto2" class="selectpicker col-md-10" required>
                                        <?php
                                         echo "<option value=0> </option>";
                                        for ($i = 0; $i <= 59; $i++) {
                                            if ($i > 9) {
                                                echo "<option value = " . $i . ">" . $i . "</option>";
                                            } else {
                                                echo "<option value = 0" . $i . ">0" . $i . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>   
                        </div>





                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorHorario.php">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header' >
                <i class='fa fa-table'></i> LISTA DE HORARIOS- <strong> <?php echo $grupo['CursoNombre']."(".$grupo['GrupoNombre'].")";?></strong></div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Lugar</th>
                                <th>Dia</th>
                                <th>HorarioEntrada</th>
                                <th>HorarioSalida</th>
                                <th> Editar </th>
                                <th> Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array = json_decode($horarios, true);
                            $i=1;
                            foreach ($array as $valor) {
                                echo "<tr>
                            <td>" . ($valor['IdHorario']) . "</td>
                            <td>" . ($valor['LugarNombre']) . "</td>
                            <td>" . ($valor['DiaDescripcion']) . "</td>
                            <td>" . ($valor['HorarioEntrada']) . "</td>
                            <td>" . ($valor['HorarioSalida']) . "</td>
                                          
                             
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonModificar btn btn-outline-primary btn-block' value=" . $valor['IdHorario'] . "><span class='fa fa-pencil fa-2x'></a></td>
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdHorario'] . "><span class='fa fa-trash fa-2x'></a></td>
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
