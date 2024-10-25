<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");

    // Consulta a la tabla "CITAS"
    $modelo = selectFirst(pdo: Bd::pdo(), from: CITAS, where: [CITA_ID => $id]);

    if ($modelo === false) {
        $idHtml = htmlentities($id);
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Cita no encontrada.",
            type: "/error/citanoencontrada.html",
            detail: "No se encontró ninguna cita con el id $idHtml."
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "fecha" => ["value" => $modelo[CITA_FECHA]],  // Incluyendo el campo de fecha
        "hora" => ["value" => $modelo[CITA_HORA]],    // Incluyendo el campo de hora
        "estado" => ["value" => $modelo[CITA_ESTADO]], // Incluyendo el campo de estado
    ]);
});