<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestHorario extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $this->obj = new Horario("1", new Grupo(), new Lugar(), new Dia(), "9:00", "10:00", "1");
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("1", $this->obj->getId());
        $this->assertNotNull($this->obj->getGrupo());
        $this->assertNotNull($this->obj->getLugar());
        $this->assertNotNull($this->obj->getDia());
        $this->assertEquals("9:00", $this->obj->getHoraEntrada());
        $this->assertEquals("10:00", $this->obj->getHoraSalida());
        $this->assertEquals("1", $this->obj->getHorarioEstado());
    }

}