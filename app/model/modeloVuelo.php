<?php

class ModeloVuelo{
    private $db;

    public function __construct(){
        $this->db =  new PDO('mysql:host=localhost;'.'dbname=tp_web;charset=utf8', 'root', '');
    }

    public function existe($id){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM 'vuelos' WHERE 'id' = '?' )");
        $consulta->execute($id);

        $existe = $consulta->fetchColumn();
        return $existe;
    }

    public function obtenerVuelos(){
        $consulta = $this->db->prepare("SELECT 1 FROM 'vuelos' WHERE 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerVuelo($id){
        $consulta = $this->db->prepare("SELECT 1 FROM 'vuelos' WHERE 'id' = '?'");
        $consulta->execute($id);

        return $consulta->fetch(PDO::FETCH_OBJ);
    }

    
}