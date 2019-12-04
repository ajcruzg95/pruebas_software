  
<!DOCTYPE html>
<head>
    <style type="text/css">

        table{
          table-layout: fixed;
        }
        #t_listaAlumnos{
            width: 400px;
            position: absolute;
            background: white;
        }
        
        #t_listaAsistencias{
            margin-left: 400px;
            width:64%;
        }
        .registrarAlumnos{
            margin-top: 40px;
        }
    </style>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).on('change', '.checkGeneral', function() {
// code here
   var targetId = event.target.id;

   if ($("#" + targetId + ":checked").length > 0) {
      $('.'+targetId+'che').prop('checked', true);
   }
   else {
            $('.'+targetId+'che').prop('checked', false);
;
   }
   }); 
        $(document).ready(function () {
            l_alumnos = [];
            l_fechas = [];
            $var = "asistenciaAlumno";
            $("#primero").text("GESTIÓN DE " + $var);
            //$("#campoId").hide();
            $("#tabla").show();
            $("#cabeceralista").hide();
            $("#cuerpolista").hide();
            
            $(".listarAlumnos").click(function () {
                //console.log($(".selectpickerGrupos").val());
                
                if($("#idAlumno").val()!=0){
                    //console.log("ggsi");
                    $.ajax({
                        type: 'POST',
                        url: '../controller/Controlador' + $var + '.php',
                        data: {
                            idAlumno: $("#idAlumno").val(),
                            modo: 1
                        },
                        success: function (data) {
                            console.log(data);
                            var datos = $.parseJSON(data);
                            //console.log(datos);
                            var temp = "";
                            var temp2 = "";
                            var temp3 = "";
                            l_alumnos = [];
                            l_fechas = [];
                            /*$.each(datos, function() {
                                temp = '<tr><td>'+20006666+'</td><td>'+
                                        Juan Perez+'</td><td>'<input type="checkbox" name=""></td>'
                            </tr>
                            });*/
                            
                            for (var valor of datos.fechas) {
                                //console.log("Valor: " + valor.AlumnoNombre);
                                //<th scope="col" width="20%">CUI</th>
                                temp3 = temp3+'<th >'+valor+'</th>';
                                l_fechas.push(valor);
                            }
                            //temp3 = temp3+'<td>15</td>';
                            $("#fechas").html(temp3);
                            for (var valor of datos.Alumnos) {
                                //console.log("Valor: " + valor.nombre);
                                l_alumnos.push(valor.codigo);
                                temp2 = temp2+'<tr><td ><input   type="checkbox" id="'+valor.codigo+'" checked class="checkGeneral  '+valor.codigo+'checked"></td><td>'+valor.codigo+'</td><td>'+
                                valor.apellido +", "+valor.nombre+'</td></tr>';
                                 //valor.nombre +", "+valor.apellido+'</td></tr>';
                                 temp = temp+'<tr>';
                                var i=0;
                               for (var valor2 of valor.fechasAsistidas) {
                                    //console.log("Valor: " + valor.AlumnoNombre);
                                    //console.log(datos.fechas[i]);
                                 if(valor2 === '1'){
                                        temp = temp+
                                            '<td ><input type="checkbox" checked class="'+valor.codigo+"che  "+valor.codigo+datos.fechas[i]+'"></td>';
                                    }else{
                                        temp = temp+'<td ><input type="checkbox" class="'+valor.codigo+"che  "+valor.codigo+datos.fechas[i]+'"></td>';
                                    } 
                                    i++;
                                    //console.log(valor2);
                                    
                                }
                                //temp = temp+'<td><input type="checkbox"  class="'+valor.codigo+
                                  //      "2018-08-26"+'" checked></td></tr>';

                            }
                            //l_fechas.push("2018-08-26");
                            $("#listaAlumnos").html(temp2);
                            //console.log(temp);
                            $("#listaAsistencias").html(temp);
                            
                $("#cabeceralista").show();
                $("#cuerpolista").show();
                        }
                    });
                }else{
                    //console.log("ggno");
                }
            });
            $(".registrarAlumnos").click(function () {
                //console.log("gg easy mid");
                //alert("Esta seguro que desea eliminar " +data_id);
                 
                
                var registro = [];
                //console.log(l_alumnos);
                //console.log(l_alumnos.length);

                for(var i=0;i<l_alumnos.length;i++){
                    var fecha = [];
                    for(var j=0;j<l_fechas.length;j++){
                        if( $('.'+l_alumnos[i]+l_fechas[j]).is(':checked') ) {
                            //registro.push({"CUI":l_alumnos[i],"e":1,"fecha":l_fechas[j]});
                            fecha.push(1);
                        }else{
                            fecha.push(0);

                            //registro.push({"CUI":l_alumnos[i],"e":0,"fecha":l_fechas[j]});
                        }
                    }
                    registro.push({"CUI":l_alumnos[i],"e":fecha});
                }
                
                console.log(registro);
                var grupo = $(".selectpickerGrupos").val();
                var mandar  = [];
                mandar.push({"grupo":grupo ,"registro": registro})
                    $.ajax({
                    type: 'POST',
                    url: '../controller/Controlador' + $var + '.php',
                    data: {
                        registroAsistencias:JSON.stringify(mandar) ,
                        modo: 2
                    },
                    success: function (data) {
                        alert("SE GUARDO CORRECTAMENTE LAS ASISTENCIAS");
                        console.log(data);
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
                <a id="primero" href='../controller/ControladorAsistencia.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>
        <!-- Icon Cards-->

        <!-- Area para Registrare-->
        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header'>
                <i class='fa fa-table'></i> Asistencia Alumnos</div>
                <div class='card-body'>
            <div class="form-group">
                <label for="nombreTaller">CUI</label>
                <input type="text" name="idAlumno" id=idAlumno >


                
                <button class="btn btn-primary listarAlumnos">BUSCAR</button>
            </div>  
                </div>
            <div class='card-header' id ="cabeceralista">
                <i class='fa fa-table'></i> Lista de Alumnos</div>
            <div class='card-body' id ="cuerpolista">
                <div class='table-responsive'>
                    <table class='table table-bordered table-sm' id='t_listaAlumnos' cellspacing='0'>
                        <thead>
                            <tr>
                                <th scope="col" width="5%">C</th>
                                
                                <th scope="col" width="20%">CUI</th>
                                <th scope="col" width="75%">Nombre</th>
                            </tr>
                        </thead>
                        <tbody id="listaAlumnos">
                            
                        </tbody>
                    </table>
                    <table class='table table-bordered table-sm' id='t_listaAsistencias' cellspacing='0'>
                        <thead id="fechas">
                        </thead>
                        <tbody id="listaAsistencias">
                            
                        </tbody>
                    </table>
                
                </div>
                <button class="btn btn-primary registrarAlumnos">GUARDAR</button>
            </div>
        </div>
    </div>
</div>    
