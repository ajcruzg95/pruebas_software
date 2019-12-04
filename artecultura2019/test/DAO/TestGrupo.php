<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestGrupo extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new Grupo("1", new Curso(), new Docente(), "A", 50, 123, 1);
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("1",$this->obj->getId());
        $this->assertNotNull($this->obj->getCurso());
        $this->assertNotNull($this->obj->getDocente());
        $this->assertEquals("A",$this->obj->getId());
        $this->assertEquals(50,$this->obj->getGrupoCapacidad());
        $this->assertEquals(123,$this->obj->getGrupoCodigo());
        $this->assertEquals(1,$this->obj->getGrupoEstado());
    }

}