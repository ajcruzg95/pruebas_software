<?php

/* 
 *Para realizar las pruebas de conexion verificar si el servicio
 * Mysql esta encendido.
 */
//require './../conexion/conexion.php';

final class ConexionTest extends \PHPUnit_Framework_TestCase
{
    private $con;
    public function setUp() {
        $this->con = new Conexion();
    }
    public function testCreationConexion()
    {
        $this->assertNotNull($this->con);
        
    }
    public function testMetodoGetConexion(){
        $this->assertNotNull($this->con->getConexion());
    }
    public function testMetodoGetConexionPermiso(){
        $this->assertNotNull($this->con->getConexionPermiso());
    }
}

