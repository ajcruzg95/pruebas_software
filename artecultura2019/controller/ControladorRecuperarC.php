<?php

require '../model/Modelo.php';

require '../model/ModeloUsuario.php';
require '../model/ModeloDocente.php';
require_once '../conexion/conexion.php';
//require_once('../phpMailer/class.phpmailer.php');
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
//echo "hola";

                 $model = new ModeloDocente();
    
                    //$model = new ModeloDocente();
                    $correo = $_POST['emailUser'];
                    //echo "hola ".$correo;
                    $docente = json_decode($model->getRegistroPorCorreo($correo), true); 
                    //echo $docente['IdDocente'];  
                    if (count($docente) > 0) {
                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                        $mail->IsSMTP(); // enable SMTP

                        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                        $mail->SMTPAuth = true; // authentication enabled
                        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 465; // or 587
                        $mail->IsHTML(true);
                        $mail->Username = "team.getsoft";
                        $mail->Password = "darfrevis";
                        $mail->SetFrom('team.getsoft@gmail.com');
                        $mail->Subject = "Test";
                        $mail->Body = "Hola que tal, esta es tu contraseña: ".$docente['DoncenteContra'];
                        $mail->AddAddress($correo);
                        //$mail­->MsgHTML("Hola que tal, esta es tu contraseña: ".$docente['DoncenteContra ']);
                        if(!$mail->Send()) {
                            $msg ="Mensaje no enviado". $mail­->ErrorInfo;
                        } else {
                            $msg ="Mensaje enviado";
                        }
                                             
                        include '../recuperarContraseña.php';
                    } else {
                        $msg = "Correo no registrado";
                        include '../recuperarContraseña.php';
                    }
 