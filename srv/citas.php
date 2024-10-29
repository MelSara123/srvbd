<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";  // Cambiado a la nueva tabla

ejecutaServicio(function () {

    // Selección de la tabla "CITAS"
    $lista = select(pdo: Bd::pdo(), from: CITAS, orderBy: CITA_FECHA); // Ordenar por fecha

    $render = "<dl>"; // Inicia la lista de descripción
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[CITA_ID]);
        $id = htmlentities($encodeId);
        $fecha = htmlentities($modelo[CITA_FECHA]);
        $hora = htmlentities($modelo[CITA_HORA]);
        $estado = htmlentities($modelo[CITA_ESTADO]);  // Incluyendo estado
        
        $render .=
            "<dt>Cita ID: <a href='modifica.html?id=$id'>$id</a></dt>
            <dd>Fecha: $fecha</dd>
            <dd>Hora: $hora</dd>
            <dd>Estado: $estado</dd>";
    }
    $render .= "</dl>"; // Cierra la lista de descripción

    devuelveJson(["lista" => ["innerHTML" => $render]]);
});
