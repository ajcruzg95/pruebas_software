
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Sistema ARTUNSA</title>
        <!-- Bootstrap core CSS-->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin.css" rel="stylesheet">
        <script>
            function validaForm() {
                var usu = $('#usuario').val();
                var ape = $('#contrasenia').val();
                console.log("En que estas"+usu+ape);
                if (isNumber(usu) && (usu!="" && ape != "") ) {
                    alert('fake');
                    return true;
                } else {
                    alert('Solo dígitos en el usuarioOO');
                    return false;
                }
            }
            
            /*$("#ingresar").click(function(){
                if($("#usuario").val() =="" || $('#contrasenia').val()==""){
                    alert("Por favor llena los campos");
                }
                else{
                    alert("Por favor llqueena los campos");
                }
                
            });*/

        </script>
    </head>

    <body class="bg-dark">
        <div class="container">
		<br>
		
		<br>
		 <center> <h1 class="navbar-brand" href="#" style="font-size:25px; color:white;" > SISTEMA ADMINISTRATIVO ARTUNSA </h1></center>
			<div class="card card-login mx-auto mt-5">
                <center><div class="card-header">INGRESAR USUARIO</div></center>
                <div class="card-body">
                    <form action="./ControladorLogin.php" method="POST" onsubmit="return validaForm()" >
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input class="form-control" id="usuario" type="text" required  pattern="[0-9]*" name="idusuario"  placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input class="form-control" id="contrasenia" type="password" required name="contrasenia" placeholder="Contraseña">
                        </div>
                        <!--<div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> Recordar Contraseña</label>
                            </div>
                        </div>!-->
                        <input type="submit"  class="btn btn-primary btn-block" value=INGRESAR>
                    </form>
                    <div class="text-center">
                        <?php
                        if(isset($msg)){
                            echo "<a class='d-block small mt-3' style=color:red;  >" . $msg . "</a>";
                        }
                        ?>
                    </div>
                    <div class="text-center">
                        <br>
						<a id=recuperarC class="d-block small" href="../recuperarContraseña.php">Recuperar Contraseña</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>

</html>
