<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestDia extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new Dia("123", "martes", "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("123", $this->obj->getId());
        $this->assertEquals("martes", $this->obj->getDiaDescripcion());
        $this->assertEquals("1", $this->obj->getDiaEstado());
    }

}