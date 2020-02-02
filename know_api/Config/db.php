<?php

class Database
{
    private static $bdd = null;

    private function __construct() {
    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=localhost;dbname=knowledge_city", 'knowledge_user', '7979Knowledge');
        }
        return self::$bdd;
    }
}
?>