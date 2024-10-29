<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";


ejecutaServicio(function () {

    $id = recuperaIdEntero("id");
    $fecha = recuperaTexto("fecha");
    $hora = recuperaTexto("hora");
    $estado = recuperaTexto("estado");

    $estado = validaNombre($estado);

    update(
        pdo: Bd::pdo(),
        table: CITAS,
        set: [CITA_FECHA => $fecha, CITA_HORA => $hora, CITA_ESTADO => $estado],
        where: [CITA_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "fecha" => ["value" => $fecha],
        "hora" => ["value" => $hora],
        "estado" => ["value" => $estado],
    ]);
});