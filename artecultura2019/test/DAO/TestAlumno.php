<?php

/* 
 */

final class TestAlumno extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $alu;
    public function setUp() {
        $build = new BuilderAlumno("1", "DAVID", "DEZA", "COD");
        $build->celular("941264670");
        $build->contrasenia("contra");
        $build->correo("ddezav@gmail.com");
        $build->estado("1");
        $this->alu = new Alumno($build);
    }
    public function testCreation() {   
        $this->assertNotNull($this->alu);
    }

    public function testMetodoGets() {
        $this->assertEquals("1", $this->alu->getId());
        $this->assertEquals("DAVID", $this->alu->getAlumnoNombre());
        $this->assertEquals("DEZA", $this->alu->getAlumnoApellido());
        $this->assertEquals("COD", $this->alu->getAlumnoCodigo());
        $this->assertEquals("941264670", $this->alu->getAlumnoCelular());
        $this->assertEquals("contra", $this->alu->getAlumnoContrasenia());
        $this->assertEquals("ddezav@gmail.com", $this->alu->getAlumnoCorreo());
        $this->assertEquals("1", $this->alu->getAlumnoEstado());
    }

}

