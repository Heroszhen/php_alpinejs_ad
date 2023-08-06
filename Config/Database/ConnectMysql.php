<?php
namespace Config\Database;

use PDO;

class ConnectMysql{
    private static $pdo = null;

    private function __construct() {}

    public static function getPDO(){
        $infoDB = include dirname(__DIR__, 2).'/Config/Config.php';
        if (self::$pdo === null) {
            $db = dirname(__DIR__,2)."/DB/{$infoDB['dbname']}";
            $pdo = new PDO("sqlite:" . $db);
        }

        return $pdo;
    }
}
 