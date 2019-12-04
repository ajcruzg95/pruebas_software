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
if (interface_exists('OperationsController') != true) {

    interface OperationsController {

        public function inicio();

        public function agregar();

        public function modificar();

        public function eliminar();

        public function conseguir();
    }

}