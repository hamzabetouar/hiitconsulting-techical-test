<?php


namespace App\Tools\Http;


class RequestGet
{

    /**
     * @param $key
     * @return string|null
     */
    public function get($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

}