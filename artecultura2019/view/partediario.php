  
<!DOCTYPE html>
<head>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link  href="../js/datepicker/datepicker.css" rel="stylesheet">
    <script src="../js/datepicker/datepicker.js"></script>
    <script src="../js/report/jspdf.min.js"></script>
    <script src="../js/report/jspdf.plugin.autotable.js"></script>
    <script>
        var dataReporte=[];
        var fechaReporte;
        function limpiar(){
            $("#idTaller").val("");
            $("#nombreTaller").val("");
            $("#creditoTaller").val("");
        }
        function buscar(){
            // console.log("Buscar"); 
            var fechaSeleccionada = $('[data-toggle="datepicker"]').datepicker('getDate', true);
            fechaReporte = fechaSeleccionada;
            var dia =$('[data-toggle="datepicker"]').datepicker('getDayName', true);
            console.log(fechaSeleccionada);
            // console.log(dia);
            
            $.ajax({
                type: 'POST',
                url: '../controller/ControladorParteDiario.php',
                data: { 
                    fecha: fechaSeleccionada,
                    dia: dia,
                    modo: 1
                },
                success: function (data) {
					console.log(data);
                    var rows = $.parseJSON(data);
                     console.log("rows", rows);
                    $("#dataTable tbody").empty();
                    dataReporte = [];                    
                    $.each(rows, function (i, elem) {
                        var docenteAux = elem.docenteNombre+" "+elem.docenteApellido;
                        //var horarioAux = elem.horaEntradaHorario.substr(11,8)+"-"+elem.horaSalidaHorario.substr(11,8);
						var horarioAux = elem.horaEntradaHorario+"-"+elem.horaSalidaHorario;

                        dataReporte.push({"docente": docenteAux, "curso": elem.curso, "grupo": elem.grupo, "lugar": elem.lugar, "horario": horarioAux, "horaEntrada": elem.horaEntradaReal, "horaSalida": elem.horaSalidaReal,},);

                        $("#dataTable tbody").append("<tr><td>"+docenteAux+
                            "</td><td>"+elem.curso+
                            "</td><td>"+elem.grupo+
                            "</td><td>"+elem.lugar+
                            "</td><td>"+horarioAux+
                            "</td><td>"+elem.horaEntradaReal+
                            "</td><td>"+elem.horaSalidaReal+
                            "</td></tr>");
                    });
                }
            });
        };
        function formatDate(date) {
          var monthNames = [
            "Enero", "Febrero", "Marzo",
            "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre",
            "Noviembre", "Diciembre"
          ];

          var day = date.getDate();
          var monthIndex = date.getMonth() + 1;
          var year = date.getFullYear();
          if(monthIndex<10)
            monthIndex='0'+monthIndex;

          return day + '/' + monthIndex + '/' + year;
        }

        function generarReporte(){
            console.log("Reporte"); 
            console.log(dataReporte); 
           
                
            var doc = new jsPDF('l', 'mm', [297, 210]);
            doc.setFontSize(22);
            doc.text(70, 30, 'UNIVERSIDAD NACIONAL DE SAN AGUSTÍN');
            doc.setFontSize(30);
            doc.text(80, 60, 'ESCUELA PROFESIONAL DE \n INGENIERÍA DE SISTEMAS');
            doc.setFontSize(22);
            doc.text(105, 95, 'PARTE DIARIO (' + fechaReporte + ')');
            doc.setFontSize(10);
            doc.text(195, 110, 'FECHA CONSULTA: ' + formatDate(new Date()));

            var columns = [
                {title: "Docente", dataKey: "docente"},
                {title: "Curso", dataKey: "curso"}, 
                {title: "Grupo", dataKey: "grupo"},
                {title: "Lugar", dataKey: "lugar"},
                {title: "Horario", dataKey: "horario"},
                {title: "Hora Entrada", dataKey: "horaEntrada"},
                {title: "Hora Salida", dataKey: "horaSalida"},
            ];
            var rows = dataReporte;
            
            doc.autoTable(columns, rows, {                
                margin: {top: 120}
            });
            
            doc.save('Test.pdf');
           
        };
        
        $(document).ready(function () {
            
            $var = "PARTE DIARIO";
            $("#primero").text("GESTIÓN DE "+$var);
            $('[data-toggle="datepicker"]').datepicker({
                format: 'dd/mm/yyyy',
                days: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                daysShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
                daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
                weekStart: 1,
                months: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthsShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                autoPick: true,
                autoHide: true,
                date: new Date(2018, 5, 18)
            });
            $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {
                // console.log(e.date);
                buscar();
            });
            buscar();
        });
    </script>
    <script>
        $( function() {
            
            
        } );
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
                <a id="primero" href='../controller/ControladorParteDiario.php'></a>
            </li>
            <li class='breadcrumb-item active' id="mapa"></li>
        </ol>

        
        <!-- Example DataTables Card-->
        <div class='card mb-3' id="tabla">
            <div class='card-header'>
                <i class='fa fa-table'></i> PARTE DIARIO</div>
            <div class='card-body'>
                <div class='table-responsive'>
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="seleccionarFecha">Seleccione fecha:</label>
                                <input data-toggle="datepicker">      
                                <button type='submit' id="botonGenerarReporte" class="btn btn-primary" onclick="generarReporte()">Generar Reporte</button>
                            </div>
                        </div>    
                        <div class="form-row">
                            <div class="col-md-2">
                                <!-- <button type='submit' id="botonBuscar" class="btn btn-primary btn-block" onclick="buscar()">Buscar</button> -->
                                
                            </div>
                        </div>    
                    </div>

                    <table class='table table-bordered' id='dataTable' width='90%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Docente</th>
                                <th>Curso</th>
                                <th>Grupo</th>
                                <th>Lugar</th>
                                <th>Horario</th>
                                <th>Hora Entrada</th>
                                <th>Hora Entrada</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
