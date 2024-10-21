<?php

require_once './app/model/modeloVuelo.php';
require_once './app/views/vista.php';

class Controlador{
    private $modeloVuelo;
    private $modeloUsuario;
    private $vista;

    function __construct($res){
        $this->modeloVuelo = new ModeloVuelo();
        $this->modeloUsuario = new ModeloUsuario();
        $this->vista = new Vista($res);
    }

    function listarVuelos(){
        $vuelos = $this->modeloVuelo->obtenerVuelos();
        $this->vista->mostrarVuelos($vuelos);
    }

    function listarVuelo($id){
        if (isset($id) && !empty($id)){
            if($this->modeloVuelo->existe($id)){
                $vuelo = $this->modeloVuelo->obtenerVuelo($id);
                $this->vista->mostrarVuelo($vuelo);
            } else {
                $this->vista->error('El vuelo no existe');
            }
        } else {
            $this->vista->error('Vuelo no seleccionado');
        }
    }

    function guardarVuelo($idUser, $idVuelo){
        if (!isset($idUser) || empty($idUser)) {
            return $this->vista->error('Error con el id del usuario');
        }
    
        if (!isset($idVuelo) || empty($idVuelo)) {
            return $this->vista->error('Error con el id del usuario');
        }

        if(!$this->modeloVuelo->existe($idVuelo)){
            return $this->vista->error('El vuelo no existe');
        }
        
        if(!$this->modeloUsuario->existe($idUser)){ // comprobamos que exista en la tabla
            return $this->vista->error('El usuario no existe');
        }

        if(!$this->modeloUsuario->tieneVuelo($idUser)){
            return $this->vista->error('El usuario ya tiene un vuelo');
        }

        $this->modeloUsuario->addVuelo($idUser, $idVuelo);//le agregamos al usuario el vuelo

        header('Location: ' . BASE_URL);
    }

    function sacarVuelo($id){
        if(isset($id) && !empty($id)){
            if($this->modeloUsuario->tieneVuelo($id)){
                $this->modeloUsuario->eliminarVuelo($id);
            } else {
                $this->vista->error('El vuelo no existe');
            }
        } else {
            $this->vista->error('Vuelo no seleccionado');
        }
        header('Location: ' . BASE_URL);

    }

    function modificarVuelo($id, $modificar, $valor){
        if(isset($id) && !empty($id) && isset($modificar) && !empty($modificar) && isset($valor) && !empty($valor)){
            if($this->modeloVuelo->existe($id)){
                switch ($modificar){
                    case 'salida':
                        $this->modeloVuelo->modificarSalida($id, $valor);
                        break;
                    case 'destino':
                        $this->modeloVuelo->modificarDestino($id, $valor);
                        break;
                    case 'avion':
                        $this->modeloVuelo->modificarAvion($id, $valor);
                        break;
                    case 'hs_salida':
                        $this->modeloVuelo->modificarHsSalida($id, $valor);
                        break;
                    case 'hs_llegada':
                        $this->modeloVuelo->modificarHsLlegada($id, $valor);
                        break;
                    case 'fecha':
                        $this->modeloVuelo->modificarFecha($id, $valor);
                        break;
                    case 'precio':
                        $this->modeloVuelo->modificarPrecio($id, $valor);
                        break;
                    case 'capacidad':
                        $this->modeloVuelo->modificarCapacidad($id, $valor);
                        break;
                    case 'url_Imagen':
                        $this->modeloVuelo->modificarImagen($id, $valor);
                        break;
                    default: 
                        $this->vista->error('Error al seleccionar la celda a modificar');
                        break;
                }
            }
        }
    }

    
    function verPerfil($id){
        if($this->modeloUsuario->esAdmin($id)->administrador ){
            $vuelos = $this->modeloVuelo->obtenerVuelos();
            $this->vista->mostrarPerfilAdmistrador($vuelos);
            return;
        } else{
            $vuelo = null;
            if($this->modeloUsuario->tieneVuelo($id)){
                $usuario = $this->modeloUsuario->getUsuario($id);
                $vuelo = $this->modeloVuelo->obtenerVuelo($usuario->id_vuelo);
            }
            $this->vista->mostrarPerfil($vuelo);
            return;
        }

    }
}