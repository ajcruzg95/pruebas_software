  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
        function retornarDetalleRetiro(codigoAlumno){
            detalle = "";
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorRetirados.php',
                data: {
                    id: codigoAlumno,
                    modo: 3
                },
                success: function (data) {
                   
                    var json = $.parseJSON(data);
                    if(json.length > 0){
                        detalle ="DETALLE RETIROS\n";
                        for (var valor of json){
                            detalle =detalle+"AÑO "+valor.PeriodoAnio+" -NÚMERO "+valor.PeriodoNumero+"- TALLER "+ valor.CursoNombre+"("+valor.GrupoNombre+")\n";
                        }   
                    }
                    
                }
            });
            return detalle;
        }
        function retornarDetalleAbandono(codigoAlumno){
            detalleAbandono = "";
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorAbandonados.php',
                data: {
                    id: codigoAlumno,
                    modo: 3
                },
                success: function (data) {
                    
                    var json = $.parseJSON(data);
                    if(json.length > 0){
                        detalleAbandono ="DETALLE ABANDONOS\n";
                        for (var valor of json){
                            detalleAbandono =detalleAbandono+"AÑO "+valor.PeriodoAnio+" -NÚMERO "+valor.PeriodoNumero+"- TALLER "+ valor.CursoNombre+"("+valor.GrupoNombre+")\n";
                        }
                    }

                }
            });
            return detalleAbandono;
        }
        function retirar(data_id,nombre){
            r = confirm("Esta seguro que desea RETIRAR la matricula del alumno " + nombre);
            if (r == true) {
                $("#tabla").show();
                $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        id: data_id,
                        modo: 4
                    },
                    success: function (data) {
                        window.location.replace('../controller/ControladorAlumnoGrupo.php');
                    }
                });
            }
        }
        function eliminar(data_id,nombre){
            r = confirm("Esta seguro que desea ELIMINAR la matricula del alumno " + nombre);
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
                        window.location.replace('../controller/ControladorAlumnoGrupo.php');
                    }
                });
            }
        }
        function retornarVacantes(codigoGrupo) {
            
            vacantesGrupo = 0;
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorGrupo.php',
                data: {
                    id: codigoGrupo,
                    modo: 4
                },
                success: function (data) {
                    var names = data;
                    console.log(data);
                    var json = $.parseJSON(data);
                    vacantesGrupo = json.GrupoCapacidad - json.Matriculados;

                }
            });
            return vacantesGrupo;
        }
        function retornarMatriculas(codigoAlumno) {
            matriculas = 0;
            $.ajax({
                async: false,
                type: 'POST',
                url: '../controller/ControladorAlumnoGrupo.php',
                data: {
                    id: codigoAlumno,
                    modo: 3
                },
                success: function (data) {
                    matriculas=data;
                    
                }
            });
            return matriculas;
        }
        //funcion para validar la matricula
        function revisa() {
            var ideA = $("#idAlumno").val();
            var ideC = $("#idCurso").val();
            var nombreAlumno = $("#nombreAlumno").val();
            var nombreCurso = $("#nombreTaller").val();
            if (ideA.length != 8 || ideC == "" || nombreAlumno == "" || nombreCurso == "") {
                alert("Verificar los codigos del taller y alumno.");
                return false;
            } else {
                var bandera=false;
                $.when( retornarVacantes(ideC),
                        retornarMatriculas(ideA),
                        retornarDetalleRetiro(ideA),
                        retornarDetalleAbandono(ideA)).
                        done(function (vacantes,matriculas,retiro,abandonos) {
                    //this callback will be fired once all ajax calls have finished.
                    var r1;
                    if(retiro.length != 0 || abandonos.length!=0){
                        r1=confirm("Continuar ?\n"+retiro+abandonos);    
                    }else{
                        r1=true;
                    }
                    
                    if(r1==true){
                        if (vacantes > 0) {
                            
                            if (matriculas > 0) {
                                var r = confirm("El alumno se matriculará en mas de 1 taller");
                                if (r == true) {
                                    bandera= true;
                                } else {
                                    bandera= false;
                                }
                            } else {
                                bandera= true;
                            }
                        } else {
                            
                            alert("El taller no tiene mas vacantes,aumente la capacidad del taller para continuar");
                            bandera= false;
                        }
                    }else{
                        bandera=false;
                    }
                });


                return bandera;
                
            }
        }

        function limpiar() {
            $("#idTaller").val("");
            $("#nombreTaller").val("");
            $("#creditoTaller").val("");
        }

        $(document).ready(function () {

            $var = "AlumnoGrupo";
            $("#idCurso").keyup(function () {
                var ide = $("#idCurso").val();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorGrupo.php',
                    data: {
                        id: ide,
                        modo: 3 
                    },
                    success: function (data) {
                        //alert(data);
                        var names = data;
                        console.log(data);
                        var json = $.parseJSON(data);
                        $('#nombreTaller').val(json.CursoNombre + "(" + json.GrupoNombre + ")");
                    }
                });
            });
            $("#idAlumno").keyup(function () {
                var ide = $("#idAlumno").val();
                $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAlumno.php',
                    data: {
                        id: ide,
                        modo: 3
                    },
                    success: function (data) {
                        var names = data;
                        //console.log(data);
                        var json = $.parseJSON(data);
                        //console.log("perro " + json.AlumnoNombre + json.AlumnoApellido);
                        $('#nombreAlumno').val(json.AlumnoNombre + " " + json.AlumnoApellido);

                    }
                });


            });
            $("#primero").text("GESTIÓN DE MATRICULAS VIGENTES");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR MATRÍCULA" );
                $("#cabecera").text("REGISTRAR MATRÍCULA");
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
                <a id="primero" href='../controller/ControladorAlumnoGrupo.php'></a>
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
                    <form action="../controller/ControladorAlumnoGrupo.php" method='POST' onsubmit=" return revisa()">

                        <input class='form-control' id='id' type='hidden' name='idAlumnoGrupo' aria-describedby='nameHelp'   placeholder='Id del Taller'>
                        
                        <div class="form-group">
                            <label for="nombreTaller">Codigo Alumno</label>
                            <input class='form-control' id='idAlumno' type='text' name='idAlumno' autocomplete="off" aria-describedby='nameHelp'  placeholder='CUI Alumno'>

                        </div> 

                        <div class="form-group">
                            <label for="creditoTaller">Nombre Alumno</label>
                            <input class="form-control" id="nombreAlumno" val="" type="text" name='nombreAlumno' aria-describedby="nameHelp" disabled placeholder="Nombre Alumno">

                        </div>  

                        <div class="form-group">
                            <label for="idTaller">Codigo Taller</label>
                            <input class='form-control' id='idCurso' type='text' name='idCurso' autocomplete="off" aria-describedby='nameHelp'   placeholder='Id del Taller'>

                        </div>    

                        <div class="form-group">
                            <label for="nombreTaller">Nombre Taller</label>
                            <input class='form-control' id='nombreTaller' type='text' name='nombreCurso' aria-describedby='nameHelp' disabled placeholder='Nombre del curso'>

                        </div> 


                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">MATRICULAR</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorAlumnoGrupo.php">Cancelar</a>
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
                <i class='fa fa-table'></i> Lista de Matriculas</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>NombreGrupo</th>
                                <th>CodigoGrupo</th>
                                <th>CUI Alumno</th>
                                <th>Nombre Alumno</th>
                                <th> Eliminar</th>
                                <th> Retirar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //session_start();
                            
                            error_reporting(E_ERROR | E_PARSE);
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            $info=$_SESSION['info'];
                        
                            $array = json_decode($info, true);
                            $i=1;
                            foreach ($array as &$valor) {
                                echo "<tr>
                            <td> $i</td>
                            <td> $valor[CursoNombre] ($valor[GrupoNombre]) </td>
                            <td>$valor[GrupoCodigo]</td>
                            <td>$valor[AlumnoCodigo]</td>
                             <td>$valor[AlumnoNombre] $valor[AlumnoApellido]</td>
                            
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='eliminar($valor[IdAlumnoGrupo], \"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdAlumnoGrupo'] . "><span class='fa fa-trash fa-2x'></a></td>
                            
                            <td><button style=' padding: 5px 25px;padding-left: 10px;' type='submit' onclick='retirar($valor[IdAlumnoGrupo],\"$valor[AlumnoNombre] $valor[AlumnoApellido]\")' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' value=" . $valor['IdAlumnoGrupo'] . "><span class='fa fa-sign-out fa-2x'></a></td>
                            
                            
                            </tr>

                            ";
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

