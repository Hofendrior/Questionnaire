<?php
class DB {
    public static function getConn() {
        return new PDO('mysql:host=localhost;dbname=questionary', 'root', '123456');
    }
}
?>
