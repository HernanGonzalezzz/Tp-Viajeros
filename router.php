<?php

require_once = './app/controller/controlador.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$action = 'home';

if(!empty($_GET('action'))){
    $action = $_GET('action');
}

// parsea la accion para separar accion real de parametros
$parametro = explode('/', $action);

switch ($parametro[0]){
    case 'home':

        break;
    case 'Vuelos':
        $controlador = new ControladorVuelo();
        $controlador->listarVuelos();
        break;
    case 'Vuelo':
        $controlador = new ControladorVuelo();
        $controlador->listarVuelo($parametro[1]);
        break;
    case 'Guardar':
        $controlador = new ControladorVuelo();
        $controlador->guardarVuelo();
        break;
    case 'Eliminar':
        $controlador = new ControladorVuelo();
        $controlador->sacarVuelo($parametro[1]);
        break;
    case 'Modificar':
        $controlador = new ControladorVuelo();
        $controlador->modificarVuelo($parametro[1], $parametro[2], $parametro[3]);
        break;
    case 'Usuarios':
        break;
    case 'Usuario':
        break;
    default: 
    echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
    break;
}