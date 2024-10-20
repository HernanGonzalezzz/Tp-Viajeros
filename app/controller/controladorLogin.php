<?php

require_once './app/model/modeloUsuario.php';
require_once './app/views/vista_login.php';

class ControladorLogin{
    private $modelo;
    private $vista;

    public function __construct($res){
        $this->modelo = new ModeloUsuario();
        $this->vista = new VistaLogin($res);
    }

    function mostrarLogin(){
        $this->vista->mostrarLogin();
    }

    function login(){
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->vista->mostrarLogin('Falta completar el email de usuario');
        }
    
        if (!isset($_POST['clave']) || empty($_POST['clave'])) {
            return $this->vista->mostrarLogin('Falta completar la contraseña');
        }

        $email = $_POST['email'];
        $clave = $_POST['clave'];

        // Verificar que el usuario está en la base de datos
        $usuarioDB = $this->modelo->getUsuarioConEmail($email);

        if($usuarioDB && password_verify($clave, $usuarioDB->clave)){
            // Guardo en la sesión el ID del usuario
            session_start();
            $_SESSION['id_user'] = $usuarioDB->id;
            $_SESSION['email'] = $usuarioDB->email;
            $_SESSION['administrador'] = $usuarioDB->administrador;
    
            // Redirijo al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->vista->mostrarLogin('Credenciales incorrectas');
        }

    }

    function mostrarRegistro(){
        $this->vista->mostrarRegistrarse();
    }

    function registrarse(){
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->vista->mostrarRegistrarse('Falta completar el email ');
        }

        if($this->modelo->existeEmail($_POST['email'])){
            return $this->vista->mostrarRegistrarse('El email ya se encuentra registrado');
        }
    
        if (!isset($_POST['clave']) || empty($_POST['clave'])) {
            return $this->vista->mostrarRegistrarse('Falta completar la contraseña');
        }

        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->vista->mostrarRegistrarse('Falta completar el nombre');
        }

        
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre'];

        $claveHash = password_hash($clave, PASSWORD_DEFAULT);
        //luego se deberia guardar los valores en la tabla
        
        header('Location: ' . BASE_URL);
    }

    function mostrarPerfil(){
        $this->vista->mostrarPerfil();
    }

    public function cerrarSesion() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
    
}