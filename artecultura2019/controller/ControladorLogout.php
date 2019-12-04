<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// remove all session variables
session_start();
if (isset($_SESSION['IdUsuario'])||isset($_SESSION['IdTipoUsuario'])) {
    session_unset(); 
    session_destroy();
}
header('Location: ControladorLogin.php');


