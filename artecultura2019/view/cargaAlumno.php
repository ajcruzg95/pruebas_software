<!DOCTYPE html>

<head>
    <title>Cargar lista de alumnos</title>
</head>
<style>

.loader{
  width: 100px;
  height: 100px;
  border-radius: 100%;
  position: absolute;
  margin-left: 50% ;
  margin-top: 10% ;
  z-index: 1;
}

/* LOADER 1 */

#loader-1:before, #loader-1:after{
  content: "";
  position: absolute;
  top: -10px;
  left: -10px;
  width: 100%;
  height: 100%;
  border-radius: 100%;
  border: 10px solid transparent;
  border-top-color: #3498db;
}

#loader-1:before{
  z-index: 100;
  animation: spin 1s infinite;
}

#loader-1:after{
  border: 10px solid #ccc;
}

@keyframes spin{
  0%{
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100%{
    -webkit-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#loader-1").hide();    
    });
    $(function() {
        $('form').submit(function(e) {
            e.preventDefault();
            $("#loader-1").show();    
            $('#cuerpo').css('opacity', '0.9');
           
            $.ajax({
                url: '../controller/ExcelCargaAlumnos.php',
                data: new FormData(this),
                method: 'post',
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,
            }).done(function(resp) {
                $("#loader-1").hide();
                alert(resp);
                window.location.href="../controller/ControladorAlumno.php";
            });
        });
    });
</script>
<div class="loader" id="loader-1"></div>
<div id="cuerpo" class='content-wrapper'>
    
    <div class='container-fluid'>
        <!-- Breadcrumbs-->
        <ol class='breadcrumb'>
            <li class='breadcrumb-item'>
                <a id="primero" href='../controller/ControladorAlumno.php'>GESTION ALUMNO</a>
            </li>
        </ol>

        <!-- Area para Registrare-->
        <div class="container" id="registro">
            <div class="card card-register mx-auto mt-5">
                <div id="cabecera" class="card-header">CARGAR ALUMNOS</div>
                <div class="card-body">
                    <form  id="cargaAlumno_form"  enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombreTaller">Seleccione el archivo:</label>
                            <input class='form-control' type="file" id="libro" name="adjunto" accept=".xlsx">
                        </div>      

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button  type="submit" id="botonGuardar" class="btn btn-success btn-block ">Cargar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Example DataTables Card-->
    </div>
</div> 
