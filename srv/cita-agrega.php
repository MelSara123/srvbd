<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";


ejecutaServicio(function () {

    // Recuperamos los valores enviados
    $fecha = recuperaTexto("fecha");
    $hora = recuperaTexto("hora");
    $estado = recuperaTexto("estado");

    // Validaciones
    $estado = validaNombre($estado);

    // Inserción en la tabla CITAS
    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: CITAS, values: [
        CITA_FECHA => $fecha, 
        CITA_HORA => $hora, 
        CITA_ESTADO => $estado
    ]);
    
    // Obtenemos el ID generado
    $id = $pdo->lastInsertId();
    $encodeId = urlencode($id);

    // Devolvemos la respuesta
    devuelveCreated("/srv/cita.php?id=$encodeId", [
        "id" => ["value" => $id],
        "fecha" => ["value" => $fecha],
        "hora" => ["value" => $hora],
        "estado" => ["value" => $estado],
    ]);
});