<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
final class TestAsistenciaDocente extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new AsistenciaDocente("1", new Grupo(), "fecha1", "fecha2", "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("1", $this->obj->getId());
        $this->assertNotNull($this->obj->getGrupo());
        $this->assertEquals("fecha1", $this->obj->getFechaEntrada());
        $this->assertEquals("fecha2", $this->obj->getFechaSalida());
        $this->assertEquals("1", $this->obj->getEstado());
    }

}
