<?php
/**
 * Created by PhpStorm.
 * User: Diiar
 * Date: 22/1/2562
 * Time: 16:27
 */

class Db {
    private static $instance = NULL;
    private static $dsn = "mysql:dbname=equipment;host=localhost";
    private static $user = "root";
    private static $pass = "";
    private function __construct() {}
    private function __clone() {}
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(self::$dsn,self::$user,self::$pass);
            self::$instance->query("SET NAMES UTF8");
        }
        return self::$instance;
    }
}
