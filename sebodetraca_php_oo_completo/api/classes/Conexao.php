<?php
class Conexao {
    private static $host = "dpg-d1sjc3re5dus73b3pre0-a";
    private static $port = "5432";
    private static $db = "sbt_bd";
    private static $usuario = "sebodetraca";
    private static $senha = "Ye4TSEiib3f5WWoUOJILs9gKKlclqu1g";
    private static $conn;

    public static function conectar() {
        if (!isset(self::$conn)) {
            $dsn = "pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$db . ";sslmode=require";
            self::$conn = new PDO($dsn, self::$usuario, self::$senha);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
?>