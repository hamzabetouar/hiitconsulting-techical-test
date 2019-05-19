<?php


namespace App\Tools\Http;


class RequestServer
{

    /**
     * @param $key
     * @return string|null
     */
    public function get($key) {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }

}