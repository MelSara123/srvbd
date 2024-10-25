<?php

class Bd
{
    private static ?PDO $pdo = null;

    static function pdo(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                // cadena de conexión
                "sqlite:srvbd.db",
                // usuario
                null,
                // contraseña
                null,
                // Opciones: pdos no persistentes y lanza excepciones.
                [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            // Creación de la tabla "CITAS"
            self::$pdo->exec(
                "CREATE TABLE IF NOT EXISTS CITAS (
                    CITA_ID INTEGER PRIMARY KEY AUTOINCREMENT,
                    CITA_FECHA TEXT NOT NULL,
                    CITA_HORA TEXT NOT NULL,
                    CITA_ESTADO TEXT NOT NULL CHECK(CITA_ESTADO IN ('ATENDIDO', 'PENDIENTE', 'CANCELADO')),
                    CONSTRAINT CITA_FECHA_NV CHECK(LENGTH(CITA_FECHA) > 0),
                    CONSTRAINT CITA_HORA_NV CHECK(LENGTH(CITA_HORA) > 0)
                )"
            );
        }

        return self::$pdo;
    }
}
