<?php

class VistaLogin{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }

    public function mostrarLogin($error = ""){
        require './templates/formulario_login.phtml';
    }

    public function mostrarModificarUsuario($error = ""){
        require './templates/formulario_editar_usuario.phtml';
    }

    public function mostrarRegistrarse($error = ""){
        require_once './templates/formulario_registro.phtml';
    }
}