<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
final class TestAsistenciaAlumno extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new AsistenciaAlumno("123", new AsistenciaDocente(), new Alumno(), "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("123", $this->obj->getId());
        $this->assertNotNull($this->obj->getAlumno());
        $this->assertNotNull($this->obj->getIdGrupo());
        $this->assertEquals("1", $actual);
    }

}
