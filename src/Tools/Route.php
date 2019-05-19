<?php


namespace App\Tools;


use App\Tools\Http\Request;

class Route
{

    /**
     * Cherche le controller et l'action lié a l'url
     *
     * @param Request $request
     * @return array
     */
    public static function getUrlParameters(Request $request) {
        $uri = explode('/', $request->server->get('PATH_INFO'));

        $controller = !isset($uri[1]) || $uri[1] == '' ? 'Default' : ucfirst($uri[1]);
        $action = !isset($uri[2]) ? 'index' : $uri[2];
        $params = count($uri) > 3 ? array_slice($uri, 3) : [];

        return [
            'controller'    => $controller,
            'action'        => $action,
            'parameters'    => $params
        ];
    }

}