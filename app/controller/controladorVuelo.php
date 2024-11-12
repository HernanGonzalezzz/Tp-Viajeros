<?php

require_once './app/model/modeloVuelo.php';
require_once './app/model/modeloUsuario.php';
require_once './app/views/vistaVuelo.php';

class ControladorVuelo{
    private $modeloVuelo;
    private $modeloUsuario;
    private $vista;

    function __construct($res){
        $this->modeloVuelo = new ModeloVuelo();
        $this->modeloUsuario = new ModeloUsuario();
        $this->vista = new VistaVuelo($res);
    }

    
    function listarVuelos(){
        $vuelos = $this->modeloVuelo->obtenerVuelos();
        $this->vista->mostrarVuelos($vuelos);
    }

    function detallarVuelo($id){
        if (isset($id) && !empty($id)){
            if($this->modeloVuelo->existe($id)){
                $vuelo = $this->modeloVuelo->obtenerVuelo($id);
                $clientes = $this->modeloUsuario->obtenerUsuariosConVuelo($vuelo->id);
                $this->vista->mostrarVuelo($vuelo, $clientes);
            } else {
                $this->vista->error('El vuelo no existe');
            }
        } else {
            $this->vista->error('Vuelo no seleccionado');
        }
    }

    function mostrarEditar($id){
        if(!isset($id) || empty($id)){
            $this->vista->error("Error al cargar los datos");
        }

        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        if($vuelo != null){
            $this->vista->mostrarModificarVuelo($vuelo,"");
        }else {
            $this->vista->error("El vuelo no existe");
        }
    }

    public function editar($id){
        $vuelo = $this->modeloVuelo->obtenerVuelo($id);
        if (empty($_POST['salida']) || !isset($_POST['salida'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de Salida");
        }
        if (empty($_POST['destino']) || !isset($_POST['destino'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de Destino");
        }
        if (empty($_POST['avion']) || !isset($_POST['avion'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos del Avion");
        }
        if (empty($_POST['hs_salida']) || !isset($_POST['hs_salida'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de la Hora de Salida");
        }
        if (empty($_POST['hs_llegada']) || !isset($_POST['hs_llegada'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de la Hora de Llegada");
        }
        if (empty($_POST['fecha']) || !isset($_POST['fecha'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de la Fecha");
        }
        if (empty($_POST['precio']) || !isset($_POST['precio'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos del Precio");
        }
        if (empty($_POST['capacidad']) || !isset($_POST['capacidad'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de la Capacidad");
        }
        if (empty($_POST['url_Imagen']) || !isset($_POST['url_Imagen'])) {
            return $this->vista->mostrarModificarVuelo($vuelo, "Error con los datos de la Url_Imagen");
        }
        
        $salida = $_POST['salida'];
        $destino = $_POST['destino'];
        $avion = $_POST['avion'];
        $hs_salida = $_POST['hs_salida'];
        $hs_llegada = $_POST['hs_llegada'];
        $fecha = $_POST['fecha'];
        $precio = $_POST['precio'];
        $capacidad = $_POST['capacidad'];
        $url_Imagen = $_POST['url_Imagen'];

        $this->modeloVuelo->modificarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad,$url_Imagen,$id);
        header('Location: ' . BASE_URL . 'Vuelos/'.$id);
    }

    function mostrarInsertar(){
        $this->vista->mostrarInsertarVuelo();
    }

    function insertar(){
        if (empty($_POST['salida']) || !isset($_POST['salida'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de Salida");
        }
        if (empty($_POST['destino']) || !isset($_POST['destino'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de Destino");
        }
        if (empty($_POST['avion']) || !isset($_POST['avion'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos del Avion");
        }
        if (empty($_POST['hs_salida']) || !isset($_POST['hs_salida'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de la Hora de Salida");
        }
        if (empty($_POST['hs_llegada']) || !isset($_POST['hs_llegada'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de la Hora de Llegada");
        }
        if (empty($_POST['fecha']) || !isset($_POST['fecha'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de la Fecha");
        }
        if (empty($_POST['precio']) || !isset($_POST['precio'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos del Precio");
        }
        if (empty($_POST['capacidad']) || !isset($_POST['capacidad'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de la Capacidad");
        }
        if (empty($_POST['url_Imagen']) || !isset($_POST['url_Imagen'])) {
            return $this->vista->mostrarInsertarVuelo("Faltan los datos de la Url imagen");
        }
        
        $salida = $_POST['salida'];
        $destino = $_POST['destino'];
        $avion = $_POST['avion'];
        $hs_salida = $_POST['hs_salida'];
        $hs_llegada = $_POST['hs_llegada'];
        $fecha = $_POST['fecha'];
        $precio = $_POST['precio'];
        $capacidad = $_POST['capacidad'];
        $url_Imagen = $_POST['url_Imagen'];
    
        $this->modeloVuelo->insertarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen);
        header('Location: ' . BASE_URL . 'Vuelos');
    }

    
    function eliminar($id){
        if(!isset($id) || empty($id)){
            return $this->vista->error('No se puede realizar la operacion');
        }
        if(!$this->modeloVuelo->existe($id)){
            return $this->vista->error('El vuelo que quiere eliminar no existe');
        }
        $this->modeloVuelo->eliminarVuelo($id);
        header('Location: ' . BASE_URL . 'Vuelos');
    }
}