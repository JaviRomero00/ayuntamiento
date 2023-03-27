<?php

    function conectar()
    {
        return new \PDO('pgsql:host=localhost,dbname=agenda', 'agenda', 'agenda');
    }

    $conectar = conectar();

    function obtener_post($par) {
        return obtener_parametro($par, $_POST);
    }

    function obtener_parametro($par, $array) {
        return isset($array[$par]) ? trim($array[$par]) : null;
    }

    function volver() {
        header('Location: /index.php');
    }
?>
