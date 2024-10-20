<?php

class ModeloVuelo{
    private $db;

    public function __construct(){
        $this->db =  new PDO('mysql:host=localhost;dbname=tp_web;charset=utf8', 'root', '');
    }

    public function existe($id){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `vuelos` WHERE `id` = ? )");
        $consulta->execute([$id]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }

    public function obtenerVuelos(){
        $consulta = $this->db->prepare("SELECT * FROM `vuelos` WHERE 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerVuelo($id){
        $consulta = $this->db->prepare("SELECT * FROM `vuelos` WHERE 'id' = '?'");
        $consulta->execute($id);
        return $consulta->fetch(PDO::FETCH_OBJ);
    }

    function agregarVuelo($salida, $destino, $avion, $hsSalida, $hsLlegada, $fecha, $precio, $capacidad, $url){
        $consulta = $this->db->prepare("INSERT INTO `vuelos`(`salida`, `destino`, `avion`, `hs_salida`, `hs_llegada`, `fecha`, `precio`, `capacidad`, 'url_Imagen') VALUES ('?','?','?','?','?','?','?','?','?')");
        $consulta->execute([$salida, $destino, $avion, $hsSalida, $hsLlegada, $fecha, $precio, $capacidad, $url]);
    }

    
    function eliminarVuelo($id){
        $consulta = $this->db->prepare("DELETE FROM `vuelos` WHERE `id` = ?");
        $consulta->execute([$id]);
    }

    function modificarSalida($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `salida` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarDestino($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `destino` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarAvion($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `avion` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarHsSalida($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `hs_salida` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarHsLlegada($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `hs_llegada` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarFecha($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `fecha` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarPrecio($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `precio` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarCapacidad($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `capacidad` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
    function modificarImagen($id, $valor){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `url_Imagen` = ? WHERE 'id'= ?");
        $consulta->execute([$valor, $id]);
    }
}