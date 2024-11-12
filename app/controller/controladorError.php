<?php

require_once './app/views/vistaVuelo.php';

class ControladorError{
    private $vista;

    public function __construct($res){
        $this->vista = new VistaVuelo($res);
    }

    function error($mensaje){
        $this->vista->error($mensaje);
    }
}