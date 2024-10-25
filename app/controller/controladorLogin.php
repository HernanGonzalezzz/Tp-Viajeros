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
            $_SESSION['nombre'] = $usuarioDB->nombre;
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
            return $this->vista->mostrarRegistrarse('Falta completar el email ...');
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
        
        $this->modelo->addUsuario($nombre,$email,$claveHash);
        
        header('Location: ' . BASE_URL);
    }

    public function mostrarModificarUsuario(){
        $this->vista->mostrarModificarUsuario();
    }

    public function editarUsuario($id){
        if (!empty($_POST['email'])) {
            if($this->modelo->existeEmail($_POST['email'])){
                return $this->vista->mostrarModificarUsuario('El email ya se encuentra registrado');
            }else{
                echo "modifico el mail";
                $email = $_POST['email'];
                $this->modelo->modificarEmail($id,$email);
            }
        }

        if (!empty($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $this->modelo->modificarNombre($id,$nombre);
            
        }

        if( !empty($_POST['claveVieja'])){
            $usuario = $this->modelo->getUsuario($id);
            $claveVieja = $_POST['claveVieja'];
            if(password_verify($claveVieja, $usuario->clave)){
                if (isset($_POST['claveNueva']) || !empty($_POST['claveNueva'])){
                    $clave = $_POST['claveNueva'];
                    $claveHash = password_hash($clave, PASSWORD_DEFAULT);
                    $this->modelo->modificarClave($id, $claveHash);
                }else{
                    return $this->vista->mostrarModificarUsuario('Ingrese una clave nueva');
                }
            } else{
                return $this->vista->mostrarModificarUsuario('La clave vieja es incorrecta');
            }
        }
        header('Location: ' . BASE_URL);
    }

    public function cerrarSesion() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
    
}