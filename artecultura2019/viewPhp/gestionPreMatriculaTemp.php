  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../vendor/jquery-cookie-master/src/jquery.cookie.js"></script>
    <script>
        
    </script>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SISTEMA DE PRE-MATRICULA </title>
        <!-- Bootstrap core CSS-->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
		<link href="../vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin.css" rel="stylesheet">
        <link href="../css/prematricula.css" rel="stylesheet">

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../vendor/datatables/jquery.dataTables.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="../js/sb-admin-datatables.min.js"></script>
        <script src="../js/sb-admin-charts.min.js"></script>

        <script>
            $(document).ready(function(){
                //$.cookie("flag", 1);
                var tiempo = new Date();
                var hora = tiempo.getHours();
                var minuto = tiempo.getMinutes();
                var segundo = tiempo.getSeconds();
                var primerApellido="";
                var nombreCompleto="gg";
                var codigoEnviadoaAcorreo="";
                $('#botonGuardar').attr("disabled","disabled");
                $('#botonPre').attr("disabled","disabled");
                $('#GrupoCodigo').blur(function(){
                    var cui=$('#GrupoCodigo').val();
                    $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAlumno.php',
                    data: {
                        id: cui,
                        modo: 3
                    },
                    success: function (data) {
                        try{
                        var json = $.parseJSON(data);
                         $('#mensaje').attr("style","color:green");
                           
                            //console.log("perro " + json.AlumnoNombre + json.AlumnoApellido);
                            $('#mensaje').text("Alumno Encontrado");
                            nombreCompleto=json.AlumnoNombre + json.AlumnoApellido;
                            primerApellido=json.AlumnoApellido;
                        }catch(e){
                             $('#mensaje').attr("style","color:red");
                            $('#mensaje').text("CUI Inválido ó No Encontrado");
                             $('#botonGuardar').attr("disabled","disabled");
                        }
                    }
                });
                }); 
                $('#correo').keyup(function(){
                    console.log(nombreCompleto);
                    var msj=nombreCompleto;
                    var correo=$('#correo').val();
                    var primerApe=primerApellido.split(" ");
                    var priape=primerApe[0].toLowerCase();
                    var ctm=correo[correo.length-1];

                    var myArray = /d(b+)d/g.exec('cdbbdbsbz');
                    if( (correo[0].toUpperCase()==msj[0]) &&( correo.substring(1,correo.length).includes(priape))&&(correo.includes("@unsa.edu.pe")) 
                        &&(ctm=="e") && correo.match(/^[a-z]+@unsa[.]edu[.]pe$/) && correo!=null ){
                            $('#correomensaje').attr("style","color:green");
                            //console.log("perro " + json.AlumnoNombre + json.AlumnoApellido);
                            $('#correomensaje').text("correo válido");

                            $('#botonGuardar').removeAttr("disabled");
                    }else{
                             $('#correomensaje').attr("style","color:red");
                            $('#correomensaje').text("coreo inválido");
                             $('#botonGuardar').attr("disabled","disabled");
                    }
                }); 
                botonPre 
                $('#botonPre').click(function() {
                    
                        //rellenar los grupos 
                        alumCod=$('#GrupoCodigo').val();
                        curso=$('#IdCurso').val();
                        grupo=$('#IdGrupo').val();
                        $.ajax({
                            type: 'POST',
                            url: '../controller/ControladorPrematricula.php',
                            data: {
                                id: alumCod,
                                modo: 6,
                                cur : curso,
                                grup:grupo

                            },
                            success: function (data) {
                                alert(data);
                                location.reload(true);
                              console.log(data);
                                //alert("se envió exitosamente codigo a su correo!");
                            }
                        });                        
                    

                });
                $('#botonGuardar').click(function() {
                    
                        //rellenar los grupos 
                        correo=$('#correo').val();
                        $.ajax({
                            type: 'POST',
                            url: '../controller/ControladorPrematricula.php',
                            data: {
                                id: correo,
                                modo: 5
                            },
                            success: function (data) {
                                codigoEnviadoaAcorreo=data;
                                $('#botonGuardar').attr("disabled");
                                //console.log("codigo="+data);
                                alert("se envió exitosamente codigo a su correo!");
                            }
                        });                        
                    

                });
                var boton = document.getElementById('botonGuardar');
                boton.addEventListener("click", bloquea, false); 
                function bloquea(){
                  if(boton.disabled == false){
                     boton.disabled = true;
                     
                     setTimeout(function(){
                        boton.disabled = false;
                    }, 100000)
                  }
                }
                function contarSegundos(){
                    
                    tiempoInicio  = $.now();
                    $.cookie("tiempo", tiempoInicio);


                }
                function validar (){

                    var timeEspera  = $.now()- $.cookie("tiempo");
                    if (timeEspera < 1000 ){

                        
                        $(this).attr("disabled", true);
                    }


                }
                $('#IdCurso').on('change', function() {
                    if(this.value!=""){
                        //rellenar los grupos 
                        idCurso=this.value;
                        $.ajax({
                            type: 'POST',
                            url: '../controller/ControladorPrematricula.php',
                            data: {
                                id: idCurso,
                                modo: 3
                            },
                            success: function (data) {
                                
                                var names = data;
                                var json = $.parseJSON(data);
                                var grupos="";
                                for(var grupo of json){
                                    grupos+=("<option value="+grupo.IdGrupo+">"+grupo.GrupoNombre+"</option>")
                                }
                                $("#IdGrupo").append(grupos);
                            }
                        });                        
                    }

                });
                $( "#codigo" ).focus(function() {
                    var codigo =$( "#codigo" ).val(); 
                    if(codigo==codigoEnviadoaAcorreo && codigo!=""){
                        $( "#botonPre" ).removeAttr("disabled");
                    }
                    else{
                        $( "#botonPre" ).attr("disabled","disabled");
                    }
                });
                $( "#codigo" ).keyup(function() {
                    var codigo =$( "#codigo" ).val(); 
                    if(codigo==codigoEnviadoaAcorreo && codigo!=""){
                        $( "#botonPre").removeAttr("disabled");
                    }
                    else{
                        $( "#botonPre").attr("disabled","disabled");
                    }
                });
                $('#IdGrupo').on('change', function() {
                    if(this.value!=""){
                        //rellenar los grupos 
                        idGrupo=this.value;
                        
                        $.ajax({
                            type: 'POST',
                            url: '../controller/ControladorPrematricula.php',
                            data: {
                                id: idGrupo,
                                modo: 4
                            },
                            success: function (data) {
                                
                                var names = data;
                                var json = $.parseJSON(data);
                                var horarios="";
                                $('#dataTable tbody').html('');
                                for(var horario of json){
                                    horarios="<tr>";
                                    horarios+=("<td>"+horario.DiaDescripcion+"</td>")
                                    horarios+=("<td>"+horario.LugarNombre+"</td>")
                                    horarios+=("<td>"+horario.HorarioEntrada+"-"+horario.HorarioSalida+"</td>")
                                    horarios+="</tr>"
                                }
                                
                                $("#horario").append(horarios);
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
<body>

<div class='col-lg-12 container'>
    
    <div style="text-align: center" class="cab_container">
      <h3 class="lartunsa">OFICINA DE ARTE Y CULTURA</h3>
      <h2 class="lprematricula">PREMATRICULA</h2>
    </div>
        <!-- Breadcrumbs-->
        <!-- Icon Cards-->

    <div class ="row col-lg-12 container-center">
        <div class="form-group col-lg-12">
            <div class="form-row col-lg-12">
            <form clas ="col-lg-12" action="../controller/ControladorPrematricula.php" method='POST'>
                        

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="nombreTaller">Talleres:</label>
                                </div>
                               
                                <div class="col-lg-12">
                                    <select id="IdCurso" name="IdCurso" class="selectpicker col-md-12 form-control">
                                        <option value=""> </option>
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

                        <div class="form-group ">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="grupos">Grupos:</label>
                                </div>
                                <div class="col-lg-12">
                                    <select id="IdGrupo" name="IdGrupo" class="selectpicker  col-md-12 form-control">
                                        <option value=""> </option>
                                        
                                    </select>
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="nombreGrupo">Horarios:</label>
                                </div>
                                <div class="col-lg-12">
                                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                        <tbody id="horario">
                                            
                                            
                                        </tbody>
                                    </table>    
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">CUI del Alumno:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' id='GrupoCodigo' type='text' name='GrupoCodigo' aria-describedby='nameHelp' placeholder='CUI del Alumno' autocomplete="off">

                                    <span id=mensaje ></span>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="capacidadGrupo">Correo Institucional:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' id='correo' type='text' name='correo' aria-describedby='nameHelp' placeholder='ddezav@unsa.edu.pe' autocomplete="off" required>
                                    <span id=correomensaje ></span>
                                </div>
                                <div class="col-lg-3">
                                <button type='button' id="botonGuardar" class="btn btn-primary btn-block">Enviar Código</button>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="capacidadGrupo">Ingresa el código Enviado:</label>
                                </div>
                                <div class="col-lg-12">
                                <input class='form-control' id='codigo' type='text-area' name='codigo' aria-describedby='nameHelp' placeholder='Código Enviado' autocomplete="off">
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <button type='button' id="botonPre" class="btn btn-success btn-block ">Pre Matricular</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Area para Registrare-->
       
</div>    
</body>
