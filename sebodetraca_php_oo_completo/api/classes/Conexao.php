<?php
class Conexao {
    private static $host = "localhost";
    private static $db = "sebodetraca";
    private static $usuario = "root";
    private static $senha = "";
    private static $conn;

    public static function conectar() {
        if (!isset(self::$conn)) {
            self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$usuario, self::$senha);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
?>