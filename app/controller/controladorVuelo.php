<?php

require_once './app/model/modeloVuelo.php';
require_once './app/views/vista.php';

class ControladorVuelo{
    private $modeloVuelo;
    private $vista;

    function __construct(){
        $this->modeloVuelo = new ModeloVuelo();
        $this->vista = new Vista();
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

    function guardarVuelo(){

    }

    function sacarVuelo($id){
        if(isset($id) && !empty($id)){
            if($ths->modeloVuelo->existe($id)){
                $this->modeloVuelo->eliminarVuelo($id);
            } else {
                $this->vista->error('El vuelo no existe');
            }
        } else {
            $this->vista->error('Vuelo no seleccionado');
        }
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
}