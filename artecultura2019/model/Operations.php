<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Win 8
 */
interface Operations {
    
    public function getLista();
    public function getRegistroPorId($id);
    public function updRegistro($registro);
    public function delRegistroPorId($id);
    public function addRegistro( $registro);
    
}
