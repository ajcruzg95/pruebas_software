<?php

require  '../conexion/conexion.php';
if (class_exists('ModeloUsuario') != true) {

    class ModeloUsuario {

        private $conn;

        public function __construct() {
            $conexion = new Conexion();
            $this->conn = $conexion->getConexionPermiso();
        }

        public function getConn() {
            return $this->conn;
        }

        public function addRegistro($registro) {

        $temp = new Usuario();
        $temp= $registro;
        
        $sql = "INSERT INTO `usuario`("
                . "`UsuarioNombre`,"
                . " `UsuarioApellido`, "
                . "`UsuarioContrasenia`,"
                . " `UsuarioEstReg`, "
                . " `IdTipoUsuario`) VALUES ('".$temp->getNombre()."','"
                . $temp->getApellido() ."',".$temp->getContrasenia().",'"
                . $temp->getEstado()."',".$temp->getTipoUsuario().")";
        
        echo $sql;        
        $this->getConn()->query($sql);
        return $sql;
            
        }

        public function delRegistroPorId($id) {
            $sql = "UPDATE `usuario` SET `UsuarioEstReg`=0 WHERE `IdUsuario`=".$id;
            echo $sql;
            $this->getConn()->query($sql);
        }

        public function getLista() {
            $sql = "SELECT * FROM `usuario` WHERE `UsuarioEstReg`=1";
            $result =  $this->getConn()->query($sql);
            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            return json_encode($outp);
        }

        public function getRegistroPorId($id) {
            $sql = "SELECT * FROM `usuario` WHERE `IdUsuario`=" . $id;

            $result = $this->getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            if (count($outp)) {
                return json_encode($outp[0]);
            } else {
                return null;
            }
            //return json_encode($sql);
        }
        public function getTodosTiposUsuarios(){
            $sql = "SELECT * FROM `tipoUsuario`";
            echo $sql;
            $result = $this->getConn()->query($sql);

            $outp = array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            
            return json_encode($outp);
            
        }
        public function RegistrarUsuario($docente) {
            $temp = new Docente();
            $temp = $docente;

            $sql = "INSERT INTO `usuario`("
                    . " `IdUsuario`, "
                    . "`IdTipoUsuario`,"
                    . " `UsuarioNombre`, "
                    . "`UsuarioApellido`,"
                    . " `UsuarioContrasenia`,`UsuarioEstReg`)"
                    . " VALUES ('" . $temp->getDocenteDni() . "','"
                    . "" . "2','" . $temp->getDocenteNombre() . "','"
                    . $temp->getDocenteApellido() . "','" . $temp->getDocenteContrasenia() . "',"
                    . "".$temp->getDocenteEstado() . ")";

            $this->getConn()->query($sql);
        }
        
        public function updRegistro($registro) {
            $temp = new Usuario();
            $temp =$registro;
            $sql="UPDATE `usuario` SET `IdTipoUsuario`=".$temp->getTipoUsuario().","
                    . "`UsuarioNombre`='".$temp->getNombre()."',"
                    . "`UsuarioApellido`='".$temp->getApellido()."',"
                    . "`UsuarioContrasenia`='".$temp->getContrasenia()."'"
                    . " WHERE `IdUsuario`=".$temp->getId();
            
           
            $this->getConn()->query($sql);
            return $sql;
        }

        public function recuperarSesion($idUsuario) {
            $model = new ModeloDocente();
            $model1 = new ModeloGrupo();

            $tabla = "docente";
            $campo = "docentedni";
            $json = json_encode($model->getListaPorCampo($tabla, $campo, $idUsuario));
            $docente = json_decode($json, true);
            if (count($docente) > 0) {
                $idDocente = $docente[0]['IdDocente'];
                $json1 = $model1->getRegistroPorIdDocente($idDocente);
                $grupo = json_decode($json1, true);
                $idGrupo = $grupo['IdGrupo'];
                $hoy = getdate();
                

                $_SESSION['IdDocente'] = $idDocente;
            }
        }

    }

}