<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (class_exists('Conexion') != true) {

    class Conexion {

        private $servername = "localhost";
        private $usernameBD = "root";
        private $usernamePe = "root";
        private $password = "";
        private $dbname = "artunsa2019";
       	private $dbnamePermiso = "artunsa2019";
        //private $dbname = "prueba";
        //private $dbnamePermiso = "prueba";
        private $conn = null;

        public function __construct() {
            
        }

        public function getConexion() {
            // Create connection
            if ($this->conn == null) {
                $this->conn = new mysqli($this->servername, $this->usernamePe, $this->password, $this->dbnamePermiso );
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
if (!$this->conn->set_charset("utf8")) {
    //printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->conn->error);
    //exit();
} else {
    //printf("Conjunto de caracteres actual: %s\n", $this->conn->character_set_name());
}	
            return $this->conn;
        }

        public function getConexionPermiso() {
            // Create connection
            if ($this->conn == null) {
                $this->conn = new mysqli($this->servername, $this->usernamePe, $this->password, $this->dbnamePermiso );
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }

            return $this->conn;
        }

    }

}








