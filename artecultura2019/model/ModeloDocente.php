<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (class_exists('ModeloDocente') != true) {
    include 'ModeloUsuario.php';
    class ModeloDocente extends Modelo implements Operations {

        public function __construct() {
            parent::__construct();
        }
        //echo "estoy en modelo Docente";
        public function addRegistro($registro) {
            $temp = new Docente();
            $temp = $registro;
            $sql = "INSERT INTO `docente`("
                    . " `DocenteNombre`,"
                    . " `DocenteApellido`,"
                    . " `DocenteCodigo`,"
                    . " `DocenteDNI`,"
                    . " `DoncenteContra`,"
                    . " `DocenteCorreo`,"
                    . " `DocenteCelular`,"
                    . " `DocenteEstado`)"
                    . " VALUES"
                    . " ('" . $temp->getDocenteNombre() . "',"
                    . "'" . $temp->getDocenteApellido() . "',"
                    . "" . $temp->getDocenteCodigo() . ","
                    . "'" . $temp->getDocenteDni() . "',"
                    . "'" . $temp->getDocenteContrasenia() . "',"
                    . "'" . $temp->getDocenteCorreo() . "',"
                    . "'" . $temp->getDocenteCelular() . "',"
                    . "" . $temp->getDocenteEstado() . ")";
            parent::getConn()->query($sql);
            
            
            $modeloUsuario=new ModeloUsuario();
            $modeloUsuario->RegistrarUsuario($registro);
            
            
        }

        public function delRegistroPorId($id) {
            $sql = "UPDATE `docente` SET `DocenteEstado`=0 WHERE `IdDocente`=" . $id;
            parent::getConn()->query($sql);
        }

        public function getLista() {
            $sql = "SELECT IdDocente,DocenteNombre,DocenteApellido,DocenteCodigo,DocenteDNI,DocenteCorreo,DocenteCelular FROM docente WHERE `DocenteEstado`=1";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            return json_encode($outp);
        }

        public function getRegistroPorId($id) {
            $sql = "SELECT * FROM `docente` WHERE `IdDocente`=" . $id;

            $result = parent::getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            return json_encode($outp[0]);
        }
        public function getRegistroPorCorreo($correo) {
            $sql = "SELECT * FROM `docente` WHERE `DocenteCorreo`='" . $correo."'";

            $result = parent::getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            if (count($outp)) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
        }
        public function updRegistro($registro) {
            $temp = new Docente();
            $temp = $registro;
            $sql = "UPDATE `docente` "
                    . "SET `DocenteNombre`='" . $temp->getDocenteNombre() . "',"
                    . "`DocenteApellido`='" . $temp->getDocenteApellido() . "',"
                    . "`DocenteCodigo`=" . $temp->getDocenteCodigo() . ","
                    . "`DocenteDNI`='" . $temp->getDocenteDni() . "',"
                    . "`DoncenteContra`='" . $temp->getDocenteContrasenia() . "',"
                    . "`DocenteCorreo`='" . $temp->getDocenteCorreo() . "',"
                    . "`DocenteCelular`='" . $temp->getDocenteCelular() . "'"
                    . " WHERE `IdDocente`=" . $temp->getId();
            parent::getConn()->query($sql);
        }

    }

}
