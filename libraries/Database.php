<?php
/**
 * retourne une connexion à la base de donnée
 * @return PDO
 */


class Database {
    private static $instance =null;

    public static function getPdo(){
    if(self::$instance===null){
    self :: $instance = new PDO('mysql:host=127.0.0.1;dbname=blissim_test;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    }
    return self::$instance;
}
}






