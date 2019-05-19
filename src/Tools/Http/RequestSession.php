<?php


namespace App\Tools\Http;


class RequestSession
{

    /**
     * @param string $key
     * @return string|null
     */
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function remove($key) {
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    public function start() {
        session_start();
    }

    public function destroy() {
        session_destroy();
    }

}