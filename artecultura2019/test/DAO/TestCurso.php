<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestCurso extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new Curso("5", "pis", "10", "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("5", $this->obj->getId());
        $this->assertEquals("pis", $this->obj->getCursoNombre());
        $this->assertEquals("10", $this->obj->getCursoCreditos());
        $this->assertEquals("1", $this->obj->getCursoEstado());
    }

}