<?php
namespace App;


use App\Tools\Http\Request;
use App\Tools\Route;

class Application
{

    /**
     * @var \Mysqli
     */
    private static $db = null;

    public static function run() {
        $request = new Request();
        $request->session->start();

        $params = Route::getUrlParameters($request);

        $controller = '\\App\Controller\\' . $params['controller'] . 'Controller';
        if( class_exists($controller)  ){
            $controller = new $controller($request);
            call_user_func_array([$controller, $params['action']], $params['parameters']);
        }
        else{
            /** @TODO end of project */
            echo 'Class not defined'; die;
        }
    }

    public function render($view, $data) {
        extract($data);
        ob_start();
        require_once ROOT_DIR . '/src/View/' . $view . '.php';
        $content = ob_get_clean();
        require_once ROOT_DIR . '/src/View/layout.php';
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