<?php

class CutomDatabase
{
    static $host = 'localhost'; // Cambia esto según tu configuración de MySQL
    static $port = '3306'; // Puerto de MySQL, 3306
    static $dbName = 'idesa'; // Nombre de tu base de datos en MySQL
    static $username = 'root'; // Nombre de usuario de MySQL
    static $password = 'root'; // Contraseña de tu usuario de MySQL

    private static $connection = null;

    public static function setDB(): void
    {
        self::getConnection()->exec("
            DROP TABLE IF EXISTS debts;
            CREATE TABLE debts(
                id INT PRIMARY KEY AUTO_INCREMENT,
                lote VARCHAR(255),
                precio INT,
                clientID INT,
                vencimiento DATE
            );
            INSERT INTO debts(lote, precio, clientID, vencimiento) VALUES 
                ('00145', 150000, 123456, '2022-09-01'),
                ('00146', 110000, 135486, NULL),
                ('00147', 160000, 135486, NULL),
                ('00148', 130000, 123456, '2022-10-01'),
                ('00148', 145000, 123456, NULL),
                ('00148', 190000, 123456, '2022-12-01'),
                ('00148', 190000, 123456, '2023-01-01'),
                ('00148', 190000, 123456, '2023-02-01');
        ");
    }

    public static function getConnection()
    {
        if (self::$connection === null) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$dbName, self::$port);
            if (self::$connection->connect_error) {
                die("Error de conexión a la base de datos: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
