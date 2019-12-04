<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    
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
        
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin.css" rel="stylesheet">
        <link href="../css/prematricula.css" rel="stylesheet">

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        
        <!--<script src="../js/sb-admin-charts.min.js"></script>-->
        <script type="text/javascript">
		function revisaCUI(){
                        alumCod=$('#GrupoCodigo').val();
			if(!/^([0-9]){8}$/.test(alumCod)){
				alert("Ingresar CUI valido");
                                return false;	
			}	
		}	
                 function revisaForm(){      
                        
                        //rellenar los grupos 
                        alumCod=$('#GrupoCodigo').val();
                        curso=$('#IdCurso').val();
                        grupo=$('#IdGrupo').val();
                         cel1=$('#cel').val();
                        percel1=$('#percel').val();
                        pernom1=$('#pernom').val();

			if(!/^([0-9]){8}$/.test(alumCod)){
				alert("Ingresar CUI valido");
                                return false;	
			}			

                        if(curso==""){
                            alert("Elegir un Taller");
                            return false;
                        }
                        if(grupo==""){
                            alert("Elegir un Grupo del Taller");
                            return false;
                        }
			if(!/^([0-9]){9}$/.test(cel1)){
                            alert("Ingresar su celular");
                            return false;
                        }
                        
			if(!/^([0-9]){9}$/.test(percel1)){
                            alert("Ingresar su celular");
                            return false;
                        }
			if((percel1==cel1)){
                            alert("Ingresar un celular distinto");
//event.preventDefault();
                            return false;
                        }return true;
                };
            $(document).ready(function(){
                //$.cookie("flag", 1);
                var tiempo = new Date();
                var hora = tiempo.getHours();
                var minuto = tiempo.getMinutes();
                var segundo = tiempo.getSeconds();
                var primerApellido="";
                var nombreCompleto="gg";
                var codigoEnviadoaAcorreo="";
                var flag=0;
                $('#botonGuardar').attr("disabled","disabled");
                //$('#botonPre').attr("disabled","disabled");
                $('#IdCurso').attr("disabled","disabled");
                $('#IdGrupo').attr("disabled","disabled");
                $('#cel').attr("disabled","disabled");
                $('#pernom').attr("disabled","disabled");
                $('#percel').attr("disabled","disabled");
                $('#correo').attr("disabled","disabled");
                $('#codigo').attr("disabled","disabled");

		$('#preinscripcion').hide();
		$('#descarga').hide();
				
		$("#btnTopPreinscripcion").click(function(){
				   
		   $('#preinscripcion').show();
			$('#descarga').hide();
		});
		$("#btnTopDescarga").click(function(){
				   
		    $('#preinscripcion').hide();
		    $('#descarga').show();
		});
				
                

                $('#GrupoCodigo').keyup(function(){
                    var cui=$('#GrupoCodigo').val();
                    $.ajax({
                    type: 'POST',
                    url: '../controller/ControladorAlumno.php',
                    data: {
                        id: cui,
                        modo: 3
                    },
                    success: function (data) {
			console.log(data);
                        try{
                        var json = $.parseJSON(data);
                         $('#mensaje').attr("style","color:green");
                            nombreCompleto=json.AlumnoNombre +" "+ json.AlumnoApellido;
                            primerApellido=json.AlumnoApellido;
                            
                           // $('#mensaje').text("Alumno Encontrado ");
                            $('#mensaje').text("Alumno Encontrado: "+nombreCompleto);
                           
                            //console.log(nombreCompleto);
                            flag=1;
                             $('#IdCurso').removeAttr("disabled");
                             $('#IdGrupo').removeAttr("disabled");
                             $('#cel').removeAttr("disabled");
                             $('#pernom').removeAttr("disabled");
                             $('#percel').removeAttr("disabled");
                             $('#correo').removeAttr("disabled");
                             $('#codigo').removeAttr("disabled");
                        }catch(e){
                             $('#mensaje').attr("style","color:red");
                            $('#mensaje').text("CUI Inválido ó No Encontrado");
                             $('#botonGuardar').attr("disabled","disabled");
                             flag=0;
                             $('#IdCurso').attr("disabled","disabled");
                            $('#IdGrupo').attr("disabled","disabled");
                            $('#cel').attr("disabled","disabled");
                            $('#pernom').attr("disabled","disabled");
                            $('#percel').attr("disabled","disabled");
                            $('#correo').attr("disabled","disabled");
                            $('#codigo').attr("disabled","disabled");
                        }
                    }
                });
                }); 
                /*$('#correo').keyup(function(){
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
                            $i('#correomensaje').text("coreo inválido");
                             $('#botonGuardar').attr("disabled","disabled");
                    }
                }); */
                 $('#correo').keyup(function(){
                    console.log(nombreCompleto);
                    var msj=nombreCompleto;
                    var correo=$('#correo').val();

                    var myArray = /d(b+)d/g.exec('cdbbdbsbz');
                    if( correo.length>10 && flag==1){ 
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
                 
                //$('#botonPre').click(function() {
                $('#botonGuardar').click(function() {
                    
                        //enviar codigo al correo
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
                                alert("Se envió exitosamente el código a su correo!");
                            }
                        });                        
                    

                });
                /*var boton = document.getElementById('botonGuardar');
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


                }*/
                function validar (){

                    var timeEspera  = $.now()- $.cookie("tiempo");
                    if (timeEspera < 1000 ){

                        
                        $(this).attr("disabled", true);
                    }


                }
                $('#IdCurso').on('change', function() {
                    if(this.value!==""){
                        //rellenar los grupos 
                        console.log("entro a idcurso");
                        idCurso=this.value;
                        $.ajax({
                            type: 'POST',
                            url: '../controller/ControladorPrematricula.php',
                            data: {
                                id: idCurso,
                                modo: 3
                            },
                            success: function (data) {
                   		console.log(data);             
                                var names = data;
                                var json = $.parseJSON(data);
                                //var grupos="";
                                $('#IdGrupo').html('');
                                var grupos=("<option value="+"></option>");
                                for(var grupo of json){
                                    if(grupo.selecionable==1){
                                        grupos+=("<option value="+grupo.IdGrupo+">"+grupo.GrupoNombre+"</option>");
                                    }else{
                                        grupos+=("<option disabled value="+grupo.IdGrupo+">"+grupo.GrupoNombre+"</option>");
                                    }
                                }
                                $("#IdGrupo").append(grupos);
                                $('#horario').html('');
                            }
                        });                        
                    }else{
                        $('#IdGrupo').html('');
                        var grupos2=("<option value="+"></option>");
                        $("#IdGrupo").append(grupos2);
                        $('#horario').html('');

                    }

                });
                
                /*
                
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
                });*/
               $('#IdGrupo').on('change', function() {
                    if(this.value!==""){
                        //rellenar los horarios 
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
                                $('#horario').html('');
                                for(var horario of json){
                                    horarios="<tr class='horarios'>";
                                    horarios+=("<td width='25%'>"+horario.DiaDescripcion+"</td>")
                                    horarios+=("<td width='50%'>"+horario.LugarNombre+"</td>")
                                    horarios+=("<td width='25%'>"+horario.HorarioEntrada+"-"+horario.HorarioSalida+"</td>")
                                    horarios+="</tr>"
                                    
                                    $("#horario").append(horarios);
                                }
                                
                            }
                        });                        
                    }else{
                        $('#horario').html('');
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
      <h3 class="lartunsa">OFICINA DE PROMOCIÓN DE ARTE, CULTURA, DEPORTE Y RECREACIÓN</h3>
      <h2 class="lprematricula">PRE INSCRIPCIÓN</h2>
    </div>
        <!-- Breadcrumbs-->
        <!-- Icon Cards-->

    <div class ="row col-lg-12 container-center">
        <div class="form-group col-lg-12">
             <div class="form-group col-lg-12">

                            <div class="form-row">
                                <div class="col-lg-6">
                                    <a  class="btn btn-primary btn-block " id="btnTopPreinscripcion" href="#">REALIZAR PRE-INSCRIPCIÓN</a>
                                </div>
                                <div class="col-lg-6">
                                    <a  class="btn btn-secondary btn-block " id="btnTopDescarga" href="#">DESCARGAR CONSTANCIA</a>
                                </div>
                            </div>   
                        </div>

            <div id="preinscripcion"class="form-row col-lg-12">
            <form clas ="col-lg-12" action="../controller/ControladorPrematricula.php" method='POST' onsubmit="return revisaForm()">

                        
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">CUI del Alumno:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' id='GrupoCodigo' type='text' name='id' aria-describedby='nameHelp' placeholder='CUI del Alumno' autocomplete="off">

                                    <span id=mensaje ></span>
                                </div>
                            </div>   
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="nombreTaller">Talleres:</label>
                                </div>
                               
                                <div class="col-lg-12">
                                    <select id="IdCurso" name="IdCurso" class="selectpicker col-md-12 form-control">
                                        <option value=""> </option>
                                        <?php
					echo $cursos;
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
                                    <select id="IdGrupo" name="grup" class="selectpicker  col-md-12 form-control">
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
                                    <table class='table table-bordered horarios' id='dataTable' cellspacing='0'>
                                        <tbody id="horario">
                                            
                                            
                                        </tbody>
                                    </table>    
                                </div>
                            </div>   
                        </div>
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">Telf. Celular:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' type='text'  id='cel' name='cel' aria-describedby='nameHelp' placeholder='Celular' autocomplete="off">

                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">En caso de emergencia recurrir a :</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' type='text' id='pernom' name='pernom' aria-describedby='nameHelp' placeholder='Nombre Completo' autocomplete="off">

                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">Con # Telf. Celular:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control'  type='text' id ='percel' name='percel' aria-describedby='nameHelp' placeholder='Celular o teléfono de la Persona en caso de emergencia' autocomplete="off">

                                </div>
                            </div>   
                        </div>
<input type='hidden' name='modo' value=6>	
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <button type='submit' id="botonPre" class="btn btn-success btn-block " >Pre Inscripción</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Area para Registrare-->
       
<div  id="descarga" class="form-row col-lg-12">
            <form class ="col-lg-12" action="../controller/ControladorPrematricula.php" method='POST' onsubmit="resivaCUI();">
                    
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <label for="codigoGrupo">CUI del Alumno:</label>
                                </div>
                                <div class="col-lg-12">
                                    <input class='form-control' id='GrupoCodigo' type='text' name='id' aria-describedby='nameHelp' placeholder='CUI del Alumno' autocomplete="off">

                                    <span id=mensaje ></span>
                                </div>
                            </div>   
                        </div>
                        
			<input type='hidden' name='modo' value=6>	
                        <div class="form-group">

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <button type='submit' class="btn btn-success btn-block ">Descargar Constancia</button>
                                </div>
                          <br>       
                               
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </div></div>    
</body>
