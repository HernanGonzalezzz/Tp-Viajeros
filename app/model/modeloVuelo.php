<?php

require_once 'modelo.php';

class ModeloVuelo extends Modelo{

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
        $consulta = $this->db->prepare("SELECT * FROM `vuelos` WHERE `id` = ?");
        $consulta->execute([$id]);
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

    function modificarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen,$id){
        $consulta = $this->db->prepare("UPDATE `vuelos` SET `salida`=?,`destino`=?,`avion`=?,`hs_salida`=?,`hs_llegada`=?,`fecha`=?,`precio`=?,`capacidad`=?, `url_Imagen`=? WHERE `id`=?");
        $consulta->execute([$salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen,$id]);
    }

    function insertarVuelo($salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen){
        $consulta = $this->db->prepare("INSERT INTO `vuelos`(`salida`, `destino`, `avion`, `hs_salida`, `hs_llegada`, `fecha`, `precio`, `capacidad`, `url_Imagen`) VALUES (?,?,?,?,?,?,?,?,?)");
        $consulta->execute([$salida,$destino,$avion,$hs_salida,$hs_llegada,$fecha,$precio,$capacidad, $url_Imagen]);
    }
    
}