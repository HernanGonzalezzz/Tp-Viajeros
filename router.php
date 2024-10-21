<?php

require_once './libs/response.php';
require_once './app/middlewares/guardaSesion.php';
require_once './app/controller/controlador.php';
require_once './app/controller/controladorLogin.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); //Donde guardamos el usuario si es que existe

$action = 'vuelos';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$parametro = explode('/', $action);

switch ($parametro[0]){
    case 'prueba':
        require_once 'prueba.php';
        break;
    case 'vuelos':
        verificaGuardaSesion($res);
        $controlador = new Controlador($res);
        $controlador->listarVuelos();
        break;
    case 'reservarVuelo':
        verificaGuardaSesion($res);
        $controlador = new Controlador($res);
        $controlador->guardarVuelo($parametro[1],$parametro[2]);
        break;
    case 'eliminarVuelo':
        verificaGuardaSesion($res);
        $controlador = new Controlador($res);
        $controlador->sacarVuelo($parametro[1]);
        break;
    case 'modificar':
        $controlador = new Controlador();
        $controlador->modificarVuelo($parametro[1], $parametro[2], $parametro[3]);
        break;
    case 'mostrarLogin':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->mostrarLogin();
        break;
    case 'logearse':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->login();
        break;  
    case 'mostrarRegistrarse':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->mostrarRegistro();  
        break;
    case 'registrarse':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->registrarse();  
        break;
    case 'mostrarPerfil':
        verificaGuardaSesion($res);
        $controlador = new Controlador($res);
        $controlador->verPerfil($parametro[1]);
        break;
    case 'cerrarSesion':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->cerrarSesion();
        break;
    default: 
    echo "404 Page Not Found ..."; // deberiamos llamar a un controlador que maneje esto
    break;
}