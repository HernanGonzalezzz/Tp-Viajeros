<?php


class modeloUsuario{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=tp_web;charset=utf8', 'root', '');
    }

    public function existe($id){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `usuarios` WHERE `id` = ? )");
        $consulta->execute([$id]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }

    public function existeEmail($email){
        $consulta = $this->db->prepare("SELECT EXISTS( SELECT 1 FROM `usuarios` WHERE `email` = ? )");
        $consulta->execute([$email]);

        $existe = $consulta->fetchColumn();
        return $existe;
    }



    public function getUsuarioConEmail($email){
        $consulta = $this->db->prepare("SELECT * FROM `usuarios` WHERE `email` = ?");
        $consulta->execute([$email]);

        $usuario = $consulta->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    public function tieneVuelo($id){
        $consulta = $this->db->prepare("SELECT EXISTS(SELECT `id_vuelo` FROM `usuarios` WHERE `id`= ?)");
        $consulta->execute([$id]);

        $usuario = $consulta->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    public function addVuelo($idUser, $idVuelo){
        $consulta = $this->db->prepare("UPDATE `usuarios` SET `id_vuelo` = ? WHERE `id`= ?");
        $consulta->execute([$idVuelo,$idUser]);
    }
}