<?php

class VistaLogin{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }

    public function mostrarLogin($error = ""){
        require './templates/formulario_login.phtml';
    }


    public function mostrarRegistrarse($error = ""){
        require_once './templates/formulario_registro.phtml';
    }
}