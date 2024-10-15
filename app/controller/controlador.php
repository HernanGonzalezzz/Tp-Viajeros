<?php


class Controlador(){
    private $modeloVuelo;
    private $vista;

    function __construct(){
        $this->modeloVuelo = new ModeloVuelo();
        $this->vista = new Vista();
    }

    function listarVuelos(){
        $vuelos = $this->modeloVuelo->obtenerVuelos();
        $this->vista->mostrarVuelos($vuelos);
    }

    function listarVuelo($id){
        if (isset($id) && !empty($id)){
            if($this->modeloVuelo->existe($id)){
                $vuelo = $this->modeloVuelo->obtenerVuelo($id);
                $this->vista->mostrarVuelo($vuelo);
            } else {
                $this->vista->error('El usuario no existe');
            }
        }
    }
}