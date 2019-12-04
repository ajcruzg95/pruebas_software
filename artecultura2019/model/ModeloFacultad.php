<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (class_exists('ModeloFacultad') != true) {

    class ModeloFacultad extends Modelo implements Operations {

        public function __construct() {
            parent::__construct();
        }

        public function addRegistro($registro) {
            $temp = new Facultad();
            $temp = $registro;

            $sql = "INSERT INTO `facultad`"
                    . "(`FacultadNombre`,"
                    . " `FacultadEstado`)"
                    . " VALUES"
                    . " ('" . $temp->getFacultadNombre() . "',"
                    . "" . $temp->getFacultadEstado() . ")";

            parent::getConn()->query($sql);
            return $sql;
        }

        public function delRegistroPorId($id) {
            $sql = "UPDATE `facultad` SET `FacultadEstado`=0 WHERE `IdFacultad`=" . $id;

            parent::getConn()->query($sql);
        }

        public function getLista() {
            $sql = "SELECT * FROM `facultad` WHERE `FacultadEstado`=1";
            $result = parent::getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);

            return json_encode($outp);
        }

        public function getRegistroPorId($id) {
            $sql = "SELECT * FROM `facultad` WHERE `IdFacultad`=" . $id;
            //echo $sql;
            $result = $this->getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);


            return json_encode($outp[0]);
        }

        public function updRegistro($registro) {
            $temp = new Facultad();
            $temp = $registro;
            $sql = "UPDATE `facultad` SET "
                    . "`FacultadNombre`='" . $temp->getFacultadNombre() . "' "
                    . " WHERE `IdFacultad`=" . $temp->getId();
            parent::getConn()->query($sql);
            return $sql;
        }

    }

}