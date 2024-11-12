<?php

class VistaUsuario{
    private $user;

    public function __construct($res){
        $this->user = $res->user;
    }


    public function mostrarUsuarios($usuarios, $urlPagina = 'Clientes'){
        require_once './templates/lista_usuarios.phtml';
    }


    public function error($mensaje, $urlPagina = 'Error'){
        require_once './templates/error.phtml';
    }

    
    public function mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos, $error = "", $urlPagina = 'Editar'){
        require './templates/formularios/formulario_editar_usuario.phtml';
    }


    public function mostrarInsertarUsuario($error = "", $urlPagina = 'Insertar'){
        require './templates/formularios/formulario_insertar_usuario.phtml';
    }
 
}