<?php

require_once './libs/response.php';
require_once './app/middlewares/guardaSesion.php';
require_once './app/controller/controladorUsuario.php';
require_once './app/controller/controladorVuelo.php';
require_once './app/controller/controladorLogin.php';
require_once './app/controller/controladorError.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); //Donde guardamos el usuario si es que existe

$action = 'Vuelos';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$parametro = explode("/",trim($action,'/'));

switch ($parametro[0]){
    case 'Vuelos':
        verificaSesion($res);
        $controlador = new ControladorVuelo($res);
        if(isset($parametro[1])){
            $controlador->detallarVuelo($parametro[1]);
        }else {
            $controlador->listarVuelos();
        }
        break;
    case 'Cliente':
        verificaSesion($res);
        $controlador = new ControladorUsuario($res);
        $controlador->listarClientes();
        break;
    case 'MostrarEditar':
        obligaLogin($res);
        if(!isset($parametro[1]))
            header('Location: ' . BASE_URL);
        switch($parametro[1]){
            case 'Usuario':
                $controlador = new ControladorUsuario($res);
                $controlador->mostrarEditar($parametro[2]);
                break;
            case 'Vuelo':
                $controlador = new ControladorVuelo($res);
                $controlador->mostrarEditar($parametro[2]);
                break;
            default:  
                $controlador = new ControladorError($res);
                $controlador->error('Error al mostrar la tabla');
                break;
        }
        break;
    case 'cargarEditar':
        obligaLogin($res);
        if(!isset($parametro[1]))
            header('Location: ' . BASE_URL);
        switch($parametro[1]){
            case 'Usuario':
                $controlador = new ControladorUsuario($res);
                $controlador->editar($parametro[2]);
                break;
                case 'Vuelo':
                    $controlador = new ControladorVuelo($res);
                    $controlador->editar($parametro[2]);
                break;
            default:  
                $controlador = new ControladorError($res);
                $controlador->error('No se pudo ingresar los valores');
                break;
        }
        break;
    case 'Insertar':
        obligaLogin($res);
        if(!isset($parametro[1]))
            header('Location: ' . BASE_URL);
        switch($parametro[1]){
            case 'Usuario':
                $controlador = new ControladorUsuario($res);
                $controlador->mostrarInsertar();
                break;
                case 'Vuelo':
                    $controlador = new ControladorVuelo($res);
                    $controlador->mostrarInsertar();
                break;
            default:  
                $controlador = new ControladorError($res);
                $controlador->error('Error al mostrar la tabla');
                break;
        }
        break;
    case 'cargarInsertar':
        obligaLogin($res);
        if(!isset($parametro[1]))
            header('Location: ' . BASE_URL);
        switch($parametro[1]){
            case 'Usuario':
                $controlador = new ControladorUsuario($res);
                $controlador->Insertar();
                break;
            case 'Vuelo':
                $controlador = new ControladorVuelo($res);
                $controlador->Insertar();
                break;
            default: 
                $controlador = new ControladorError($res);
                $controlador->error('No se pudo ingresar los valores');
                break;
            }
        break;
    case 'Eliminar':
        obligaLogin($res);
        if(!isset($parametro[1]))
            header('Location: ' . BASE_URL);
        switch($parametro[1]){
            case 'Usuario':
                $controlador = new ControladorUsuario($res);
                $controlador->eliminar($parametro[2]);
                break;
            case 'Vuelo':
                $controlador = new ControladorVuelo($res);
                $controlador->eliminar($parametro[2]);
                break;
            default:  
                $controlador = new ControladorError($res);
                $controlador->error('No se pudo eliminar el elemento');
                break;
            }
        break;
    case 'mostrarLogin':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->mostrarLogin();
        break;
    case 'logearse':
        $controladorUser = new ControladorLogin($res);
        $controladorUser->login();
        break;  
    case 'cerrarSesion':
        obligaLogin($res);
        $controladorUser = new ControladorLogin($res);
        $controladorUser->cerrarSesion();
        break;
    default: 
    echo "404 Page Not Found ..."; // deberiamos llamar a un controlador que maneje esto
    break;
}