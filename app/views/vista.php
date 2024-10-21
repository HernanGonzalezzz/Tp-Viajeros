<?php

class Vista{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }

    public function mostrarVuelos($vuelos){
        require_once './templates/lista_vuelos.phtml';
    }

    public function mostrarVuelo($vuelo){
        //require_once ''
    }

    public function error($mensaje){
        require_once './templates/error.phtml';
    }

    public function mostrarPerfil($vuelo){
        require_once './templates/perfil.phtml';
    }
    
    public function mostrarPerfilAdmistrador($vuelos){
        require './templates/perfilAdministrador.phtml';
    }
}