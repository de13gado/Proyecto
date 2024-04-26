<?php

class DB {
    // Definir constantes para la configuración de la base de datos
    const HOST = 'localhost:3307';
    const DB_NAME = 'Proyecto';
    const USER = 'root';
    const PASSWORD = "";
    const CHARSET = 'utf8mb4';

    public function __construct() {}

    public function connect() {
        try {
            $connection = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, self::USER, self::PASSWORD, $options);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception('Error en la conexión: ' . $e->getMessage());
        }
    }
}
?>
