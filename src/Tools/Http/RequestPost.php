<?php


namespace App\Tools\Http;


class RequestPost
{

    /**
     * @param $key
     * @return string|null
     */
    public function get($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

}