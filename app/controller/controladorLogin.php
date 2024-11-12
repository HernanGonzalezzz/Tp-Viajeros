<?php

require_once './app/model/modeloAdmin.php';
require_once './app/views/vista_login.php';

class ControladorLogin{
    private $modelo;
    private $vista;

    public function __construct($res){
        $this->modelo = new ModeloAdmin();
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
        $usuarioDB = $this->modelo->obtenerUsuarioConEmail($email);

        if($usuarioDB && password_verify($clave, $usuarioDB->clave)){
            // Guardo en la sesión el ID del usuario
            session_start();
            $_SESSION['id_user'] = $usuarioDB->id;
            $_SESSION['nombre'] = $usuarioDB->nombre;
            $_SESSION['email'] = $usuarioDB->email;
    
            // Redirijo al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->vista->mostrarLogin('Credenciales incorrectas clave');
        }

    }

    

    public function cerrarSesion() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
    
}