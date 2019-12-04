<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestUsuario extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new Usuario("1", "1", "nombre", "apellido", "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("1", $this->obj->getId());
        $this->assertEquals("1", $this->obj->getTipoUsuario());
        $this->assertEquals("nombre", $this->obj->getNombre());
        $this->assertEquals("apellido", $this->obj->getApellido());
        $this->assertEquals("1", $this->obj->getEstado());
    }

}