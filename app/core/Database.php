<?php

class Database
{
    private static $conn;

    public static function getConnection()
    {
        if (!self::$conn) {
            $host = DB_HOST;
            $user = DB_USER;
            $password = DB_PASSWORD;
            $name = DB_NAME;

            self::$conn = new mysqli($host, $user, $password, $name);

            if (self::$conn->connect_error) {
                die('Koneksi gagal :' . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}