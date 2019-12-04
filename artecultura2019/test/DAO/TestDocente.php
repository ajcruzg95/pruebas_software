<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class TestDocente extends \PHPUnit_Framework_TestCase implements OperationsTestDAO
{
    private $obj;
    public function setUp() {
        $builder = new BuilderDocente("2", "sergio", "peña", "1");
        $builder->celular("941264670");
        $builder->contrasenia("CONTRA");
        $builder->correo("pepe@gmail.com");
        $builder->dni("909090");
        $builder->estado("1");
        $this->obj = new Docente($builder);
    }

    public function testCreation() {
        $this->assertNotNull($this->obj);
    }

    public function testMetodoGets() {
        $this->assertEquals("2", $this->obj->getId());
        $this->assertEquals("sergio", $this->obj->getDocenteNombre());
        $this->assertEquals("peña", $this->obj->getDocenteApellido());
        $this->assertEquals("941264670", $this->obj->getDocenteCelular());
        $this->assertEquals("CONTRA", $this->obj->getDocenteContrasenia());
        $this->assertEquals("pepe@gmail.com", $this->obj->getDocenteCorreo());
        $this->assertEquals("909090", $this->obj->getDocenteDni());
        $this->assertEquals("1", $this->obj->getDocenteEstado());
    }

}