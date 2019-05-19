<?php
namespace App;


class Application
{

    /**
     * @var \Mysqli
     */
    private static $db = null;

    public static function run() {

    }

    /**
     * @return \Mysqli
     */
    public static function getDatabase() {
        // Instantiation de la base de données si appelé la premier fois
        if( self::$db === null ) {
            $parameters = require_once ROOT_DIR . '/config/database.php';
            self::$db = new \Mysqli($parameters['host'], $parameters['user'],
                $parameters['password'], $parameters['dbname']);

            if (self::$db->connect_error) {
                die('Connect Error (' . self::$db->connect_errno . ')  - '
                    . self::$db->connect_error);
            }
        }
        return self::$db;
    }
}