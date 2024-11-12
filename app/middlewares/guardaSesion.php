<?php
    function verificaSesion($res) {
        session_start();
        if(isset($_SESSION['id_user'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->nombre = $_SESSION['nombre'];
            $res->user->email = $_SESSION['email'];
            return;
        } 
    }

    function obligaLogin($res) {
        session_start();
        if(isset($_SESSION['id_user'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->nombre = $_SESSION['nombre'];
            $res->user->email = $_SESSION['email'];
            return;
        } else {
            header( 'Location: ' .BASE_URL . 'mostrarLogin');
            die();
        }
    }
?>