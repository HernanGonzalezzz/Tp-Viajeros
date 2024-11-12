<?php

class VistaLogin{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }

    public function mostrarLogin($error = "", $urlPagina = 'Login'){
        require './templates/formularios/formulario_login.phtml';
    }

}