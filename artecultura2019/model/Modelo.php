<?php

include_once '../conexion/conexion.php';

include_once '../DAO/Alumno.php';
include_once '../DAO/AlumnoGrupo.php';
include_once '../DAO/AsistenciaAlumno.php';
include_once '../DAO/Curso.php';
include_once '../DAO/Dia.php';
include_once '../DAO/Docente.php';
include_once '../DAO/Grupo.php';
include_once '../DAO/Horario.php';
include_once '../DAO/Lugar.php';
include_once '../DAO/Usuario.php';
include_once '../DAO/Facultad.php';
include_once '../DAO/Escuela.php';
include_once '../DAO/Sede.php';
include_once '../DAO/Periodo.php';

include_once  'Operations.php';
if (class_exists('Modelo') != true) {

    class Modelo {

        private $conn;

        public function __construct() {
            $c = new Conexion();
            $this->conn = $c->getConexion();
        }

        public function getConn() {
            return $this->conn;
        }

        // retorna arreglo,para usar en un ajax json_encode a esta funcion
        public function getListaPorCampo($tabla, $campo, $valorCampo) {
            $sql = "SELECT * FROM `" . $tabla . "` WHERE `" . $campo . "`=" . $valorCampo;
            //echo $sql;
            
            $result = $this->conn->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            return ($outp);
        }

    }

}
