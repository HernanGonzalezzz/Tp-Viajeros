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
        $controlador = new Controlador();
        $controlador->listarVuelos();
        break;
    case 'Vuelo':
        $controlador = new Controlador();
        $controlador->listarVuelo($parametro[1]);
        break;
    case 'Usuarios':
        break;
    case 'Usuario':
        break;
    default: 
    echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
    break;
}