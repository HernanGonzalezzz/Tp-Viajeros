<?php

require_once './app/model/modeloVuelo.php';
require_once './app/model/modeloUsuario.php';
require_once './app/views/vistaUsuario.php';

class ControladorUsuario{
    private $modeloVuelo;
    private $modeloUsuario;
    private $vista;

    function __construct($res){
        $this->modeloVuelo = new ModeloVuelo();
        $this->modeloUsuario = new ModeloUsuario();
        $this->vista = new VistaUsuario($res);
    }

    function listarClientes(){
        $usuarios = $this->modeloUsuario->obtenerUsuarios();
        $this->vista->mostrarUsuarios($usuarios);
    }
    
    function mostrarEditar($id){
        if(isset($id) && !empty($id)){
            $usuario = $this->modeloUsuario->obtenerUsuario($id);
            $vueloUsuario = $this->modeloVuelo->obtenerVuelo($usuario->id_vuelo);
            $vuelos = $this->modeloVuelo->obtenerVuelos();
            if($usuario != null){
                $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,"");
            } else {
                $this->vista->error("El usuario no existe");
            }
        } else {
            $this->vista->error("Error al cargar los datos");
        }
    }

    public function editar($id){
        $usuario = $this->modeloUsuario->obtenerUsuario($id);
        $vueloUsuario = $this->modeloVuelo->obtenerVuelo($usuario->id_vuelo);
        $vuelos = $this->modeloVuelo->obtenerVuelos();
        if (empty($_POST['email']) || !isset($_POST['email'])) {
            return $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,'El email no fue ingresado');
        }

        if (empty($_POST['nombre']) || !isset($_POST['nombre'])) {
            return $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,'El nombre no fue ingresado');
        }
        if (empty($_POST['apellido']) || !isset($_POST['apellido'])) {
            return $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,'El apellido no fue ingresado');
        }
        
        $usuarioDb = $this->modeloUsuario->obtenerUsuarioConEmail($_POST['email']);
        if($usuarioDb && $usuarioDb->id != $id){ //controlamos que me deje guardar el email solo si pertenece al mismo usuario que estoy guardando, ya que no deben haber repetidos
            return $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,'El email ya se encuentra registrado');
        }
        if(!empty($_POST['id_vuelo'])){
            if(!$this->modeloVuelo->existe($_POST['id_vuelo'])){
                return $this->vista->mostrarModificarUsuario($usuario, $vueloUsuario, $vuelos,'El vuelo no existe');
            } else {
                $id_vuelo = $_POST['id_vuelo'];
            }
        }
        if(empty($_POST['id_vuelo'])){
            $id_vuelo = null;
        }

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        
        $this->modeloUsuario->modificarUsuario($nombre, $apellido, $email, $id_vuelo, $id);

        header('Location: ' . BASE_URL . 'Cliente');
    }
    
    function mostrarInsertar(){
        $this->vista->mostrarInsertarUsuario();
    }

    function insertar(){
        if (empty($_POST['nombre']) || !isset($_POST['nombre'])) {
            return $this->vista->mostrarInsertarUsuario("Faltan los datos del Nombre");
        }
        if (empty($_POST['apellido']) || !isset($_POST['apellido'])) {
            return $this->vista->mostrarInsertarUsuario("Faltan los datos del Apellido");
        }
        if (empty($_POST['email']) || !isset($_POST['email'])) {
            return $this->vista->mostrarInsertarUsuario("Faltan los datos del Email");
        }
        $usuarioDb = $this->modeloUsuario->obtenerUsuarioConEmail($_POST['email']);
        if($usuarioDb){
            return $this->vista->mostrarInsertarUsuario("El mail ya se encuentra registrado");
        }
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];

        $this->modeloUsuario->agregarUsuario($nombre,$apellido,$email);
        header('Location: ' . BASE_URL . 'Cliente');
    }

    function eliminar($id){
        if(!isset($id) || empty($id)){
            return $this->vista->error('No se puede realizar la operacion');
        }
        if(!$this->modeloUsuario->existe($id)){
            return $this->vista->error('El cliente que quiere eliminar no existe');
        }
        $this->modeloUsuario->eliminarUsuario($id);
        header('Location: ' . BASE_URL . 'Cliente');
    }

}