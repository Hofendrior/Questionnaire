<?php
class DB {
    public static function getConn() {
        return new PDO('mysql:host=localhost;dbname=questionnaire', 'root', '123456');
    }
}
?>
