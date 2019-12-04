  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function () {

            $var = "CERTIFICACIÓN";
            $("#primero").text("GESTIÓN DE " + $var);
            $("#campoId").hide();
            $("#registro").hide();
            $("#cabecerag").text($var+" POR CURSO");
            $("#mapa").text($var+"  POR CURSO");

            $.ajax({
                type: 'POST',
                url: '../controller/ControladorCertificacionAlumno.php',
                data: {
                    modo: 4
                },
                success: function (data) {
                    //location.reload();
                    console.log(data);
                    var json = $.parseJSON(data);
                    var temp = "";
                    for (var valor of json) {
                        temp = temp+ '<option value="'+valor.id+'">'+valor.curso+"("+valor.grupo+')</option>';
                    }
                    $("#gidCurso").html(temp);

                }
            });
            $("#botonAlumno").click(function () {
                $("#registro").show();
                $("#mapa").text($var+"  POR ALUMNO");
                $("#cabecera").text($var+" POR ALUMNO");
                $("#tabla").hide();
            });
            $("#botonGrupo").click(function () {
                $("#tabla").show();
                $("#cabecerag").text($var+" POR CURSO");
                $("#mapa").text($var+"  POR CURSO");
                $("#registro").hide();
            });
            $("#bBuscarCUI").click(function () {
                console.log("p1");
                console.log($("#cui").val());
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorCertificacionAlumno.php',
                    data: {
                        cui: $("#cui").val(),
                        modo: 3
                    },
                    success: function (data) {
                        //location.reload();
                        console.log(data);
                        var json = $.parseJSON(data);
                        var temp = "";
                        for (var valor of json) {
                            temp = temp+ '<option value="'+valor.id+'">'+valor.curso+"("+valor.grupo+')</option>';
                        }
                        $("#aidCurso").html(temp);

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
                <a id="primero" href='../controller/ControladorCertificacionAlumno.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->


        <div class="form-group">
            <div class="form-row">
                <div class="col-md-2">
                    <a class="btn btn-primary btn-block" id="botonAlumno" href="#">Alumno</a>  
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary btn-block" id="botonGrupo" href="#">Grupo</a>  
                </div>
            </div>
        </div>
        <!-- Area para Registrare-->
        <div class="container" id="registro">
            <div class="card card-register mx-auto mt-5">
                <div id="cabecera" class="card-header"></div>
                <div class="card-body">
                    <form action="../controller/ControladorCertificacionAlumnoPdf.php" target="_blank" method='POST'>
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">CUI</label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                      <input type="text" class="form-control"  id='cui' type='text' name='cui' aria-describedby='nameHelp' placeholder='CUI' value="20130873">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="bBuscarCUI">Buscar</button>
                                      </span>
                                    </div>
                                </div>
                            </div>   
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreTaller">Nombre del Taller</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="aidCurso" name="aidCurso" class="selectpicker col-md-10">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Director de la DUDE</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='addude' type='text' name='addude' aria-describedby='nameHelp' placeholder='Director de la DUDE' value="Dr. Alejandro Félix Vela Quico">
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Vicerrectora Académica</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='ada' type='text' name='ada' aria-describedby='nameHelp' placeholder='Vicerrectora Académica' value="Dra. Ana María Gutiérrez Valdivia">
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Jefa de la OPACDR</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='ajapacdr' type='text' name='ajapacdr' aria-describedby='nameHelp' placeholder='Jefa de la OPACDR' value="Lic. Lenka Rossana Treviño Mariño">
                                </div>
                            </div>   
                        </div>

                        <div class="form-group">
                            
                            <div class="form-group">

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <button  type='submit' id="botonGuardar" class="btn btn-success btn-block ">GENERAR</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-danger btn-block" href="../controller/ControladorCertificacionAlumno.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>


            </div>      


        </div>
    </div>

    <!-- Example DataTables Card-->
    <div class='card mb-3' id="tabla">
         <div class="card card-register mx-auto mt-5">
                <div id="cabecerag" class="card-header">GGGGG</div>
                <div class="card-body">
                    <form action="../controller/ControladorCertificacionAlumnoPdf.php" target="_blank" method='POST'>
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreTaller">Nombre del Taller</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="gidCurso" name="gidCurso" class="selectpicker col-md-10">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Director de la DUDE</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='gddude' type='text' name='gddude' aria-describedby='nameHelp' placeholder='Director de la DUDE' value="Dr. Alejandro Félix Vela Quico">
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Vicerrectora Académica</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='gda' type='text' name='gda' aria-describedby='nameHelp' placeholder='Vicerrectora Académica' value="Dra. Ana María Gutiérrez Valdivia">
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Jefa de la OPACDR</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='gjapacdr' type='text' name='gjapacdr' aria-describedby='nameHelp' placeholder='Jefa de la OPACDR' value="Lic. Lenka Rossana Treviño Mariño">
                                </div>
                            </div>   
                        </div>

                        <div class="form-group">
                            
                            <div class="form-group">

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">GENERAR</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-danger btn-block" href="../controller/ControladorCertificacionAlumno.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>


            </div>      
    </div>
</div>
</div>    
