<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <script>
        function cerrarAbrirGrupo(data_id,nombre,estado){
            accion="";
            if(estado==1){
                accion="CERRAR";
            }
            if(estado==2){
                accion="ABRIR";
            }
            
            r = confirm("Seguro que desea "+accion+" el taller " + nombre);
                if (r == true) {
                    $("#tabla").show();
                    $.ajax({
                        type: 'POST',
                        url: '../controller/Controlador' + $var + '.php',
                        data: {
                            id: data_id,
                            modo: 5
                        },
                    success: function (data) {
                        
                        window.location.replace('../controller/ControladorGrupo.php');
                    }
                });
            }
        }
        function editar(data_id){
            $("#botonGuardar").text("MODIFICAR");
                $("#mapa").text("MODIFICAR GRUPO-TALLER ");
                $("#cabecera").text("MODIFICAR GRUPO-TALLER ");
                
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
                        $('#IdGrupo').val(json.IdGrupo);
                        $('#IdCurso').val(json.IdCurso);
                        $('#IdDocente').val(json.IdDocente);
                        $('#GrupoNombre').val(json.GrupoNombre)
                        $('#GrupoCodigo').val(json.GrupoCodigo)
                        $('#GrupoCapacidad').val(json.GrupoCapacidad)

                    }
                });
        }
        function eliminar(data_id,nombre){
                r = confirm("Seguro que desea eliminar el taller " + nombre);
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
                            window.location.replace('../controller/ControladorGrupo.php');
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

            $var = "Grupo";
            $("#primero").text("GESTIÓN DE GRUPO-TALLER");
            $("#campoId").hide();
            $("#registro").hide();
            $("#botonAgregar").click(function () {
                $("#botonGuardar").text("GUARDAR");
                limpiar();
                $("#registro").show();
                $("#mapa").text("REGISTRAR GRUPO-TALLER");
                $("#cabecera").text("REGISTRAR GRUPO-TALLER");
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
                <a id="primero" href='../controller/ControladorGrupo.php'></a>
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
                    <form action="../controller/ControladorGrupo.php" method='POST'>
                        <div class="form-group" id="campoId">
                            <label for="nombreTaller">ID Taller</label>
                            <input class='form-control' id='IdGrupo' type='text' name='IdGrupo' aria-describedby='nameHelp' placeholder='Nombre del curso'>

                        </div> 


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreTaller">Nombre del Taller</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="IdCurso" name="IdCurso" class="selectpicker col-md-10">
                                        <?php
                                        $array = json_decode($cursos, true);
                                        foreach ($array as $value) {
                                            echo "<option value=" . $value['IdCurso'] . ">" . $value['CursoNombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombreDocente">Nombre del Instructor</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="IdDocente" name="IdDocente" class="selectpicker  col-md-10">
                                        <?php
                                        $arrayDocente = json_decode($docentes, true);
                                        foreach ($arrayDocente as $value) {
                                            echo "<option value=" . $value['IdDocente'] . ">" . $value['DocenteNombre'] . " " . $value['DocenteApellido'] . "</option>";
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
                                    <label for="nombreGrupo">Grupo Número</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='GrupoNombre' type='text' name='GrupoNombre' aria-describedby='nameHelp' placeholder='Grupo Número'>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="codigoGrupo">Código del Grupo-Taller</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='GrupoCodigo' type='text' name='GrupoCodigo' aria-describedby='nameHelp' placeholder='Código del Taller'>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="capacidadGrupo">Capacidad del Taller</label>
                                </div>
                                <div class="col-md-8">
                                    <input class='form-control' id='GrupoCapacidad' type='text' name='GrupoCapacidad' aria-describedby='nameHelp' placeholder='Capacidad del Taller'>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <button type='submit' id="botonGuardar" class="btn btn-success btn-block ">Guardar</button>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-block" href="../controller/ControladorGrupo.php">Cancelar</a>
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
                                <th>Id</th>
                                <!--<th>Nombre Instructor</th>-->
                                <th>Nombre Taller </th>
                                <th>Codigo Taller </th>
                                <th>Capacidad Taller </th>
                                <th>Matriculados Taller </th>
                                <th>Vacantes Taller </th>
                                <th> Horario </th>
                                <th> Lista </th>
                                <th> Estado </th>
                                <th> Editar</th>
                                <th> Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $arrayGrupo = json_decode($grupos, true);

                            $i=1;
                            foreach ($arrayGrupo as $valor) {
                                echo "<tr>
                            <td> $i </td>
                            <!--<td> $valor[DocenteNombre] $valor[DocenteApellido]</td>-->
                               <td><a data-toggle='modal' href=\"#$valor[IdGrupo]\">  $valor[CursoNombre] ($valor[GrupoNombre])</a></td>
                             <td> $valor[GrupoCodigo] </td>
                                 <td> $valor[GrupoCapacidad] </td>
                                 <td> $valor[Matriculados] </td>
                                 <td>" . (($valor['GrupoCapacidad'])-($valor['Matriculados'])) . "</td>" ;
                                 //horario 
                                 echo "
                            <td>
                            <form action='../controller/ControladorHorario.php' method='POST'>
                            <input type='hidden' name='IdGrupo' value=" . $valor['IdGrupo'] . ">

                            <button style=' padding: 5px 25px;padding-left: 7px;' type='submit' class=' col-md-2 botonHorario btn btn-outline-secondary btn-block'
                            value=" . $valor['IdGrupo'] . "><span class='fa fa-calendar fa-2x'></span></a>
                            </form>    
                            </td>";
                                //lista -excel
                            echo "<td>
                            <form action='../controller/ExcelListaAlumnos.php' method='POST'>
                            <input type='hidden' name='IdGrupo' value=" . $valor['IdGrupo'] . ">

                            <button style=' padding: 5px 25px;padding-left: 7px;' type='submit' class=' col-md-2 botonHorario btn btn-outline-success btn-block'
                            value=" . $valor['IdGrupo'] . "><span class='fa fa-file-excel-o fa-2x'></span></a>
                            </form>    
                            </td>";

                            //- estado
                            if($valor['GrupoEstado']==1){
                            echo "<td><button onclick='cerrarAbrirGrupo($valor[IdGrupo],\"$valor[CursoNombre] ($valor[GrupoNombre])\",$valor[GrupoEstado])' style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-10  btn btn-outline-danger btn-block'
                            ><span ><strong>Cerrar</strong></span></a></td>";
                            
                            } 
                            if($valor['GrupoEstado']==2){
                                echo "<td><button onclick='cerrarAbrirGrupo($valor[IdGrupo],\"$valor[CursoNombre] ($valor[GrupoNombre])\",$valor[GrupoEstado])' style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-10  btn btn-outline-info btn-block'
                            ><span><strong>Abrir</strong></span></a></td>";
                            
                            } 
                            
                            //- editar -eliminar
                            echo 
                                "<td><button onclick='editar( $valor[IdGrupo])' style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonModificar btn btn-outline-primary btn-block'
                            ><span class='fa fa-pencil fa-2x'></span></a></td>
                            <td><button  onclick='eliminar( $valor[IdGrupo], \"$valor[CursoNombre] ($valor[GrupoNombre])\")' style=' padding: 5px 25px;padding-left: 10px;' type='submit' class=' col-md-2 botonEliminar btn btn-outline-secondary btn-block' ><span class='fa fa-trash fa-2x'></a></td>
                                
                            </tr>";
                            
                            echo "
                            <div class='modal fade' id=\"$valor[IdGrupo]\">
                                <div class=modal-dialog>
                                    <div class=modal-content>
                                        <div class=modal-header>
                                            <p class=modal-title>Descripcion Taller</p>
                                            <button type=button class=close data-dismiss=modal>&times;</button>
                                        </div>
                                        <div class=modal-body>
                                            <div class=container-fluid>
                                                <div class=row >
                                                    <div class=col-md-6>
                                                        <label><strong>Docente del Taller</strong></label>
                                                    </div>
                                                    <div class=col-md-6>
                                                        <p><strong>$valor[DocenteNombre] $valor[DocenteApellido]</strong></p>
                                                    </div>
                                                </div>
                                                <div class=row >
                                                    <div class=col-md-6>
                                                        <label><strong>Capacidad del Taller</strong></label>
                                                    </div>
                                                    <div class=col-md-6>
                                                        <p><strong>$valor[GrupoCapacidad]</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
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
