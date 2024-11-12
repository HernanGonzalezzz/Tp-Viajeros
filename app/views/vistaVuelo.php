<?php

class VistaVuelo{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }
    
    public function mostrarVuelos($vuelos, $urlPagina = 'Vuelos'){
        require_once './templates/lista_vuelos.phtml';
    }
    
    public function mostrarVuelo($vuelo, $usuarios, $urlPagina = 'Vuelos'){
        require_once './templates/detalle_vuelo.phtml';
    }
    
    public function mostrarModificarVuelo($vuelo, $error = "", $urlPagina = 'Editar'){
        require './templates/formularios/formulario_editar_vuelo.phtml';
    }
       
    public function mostrarInsertarVuelo($error = "", $urlPagina = 'Insertar'){
        require './templates/formularios/formulario_insertar_vuelo.phtml';
    }
    
    public function error($mensaje, $urlPagina = 'Error'){
        require_once './templates/error.phtml';
    }
}