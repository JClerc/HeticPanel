<?php

class Session extends Model {

    const DEPENDENCIES = [];

    public function start() {
        session_start();
    }

    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function has($key) {
        return isset($_SESSION[$key]);
    }

    public function remove($key = null) {
        if (isset($key)) {
            unset($_SESSION[$key]);
        } else {
            session_destroy();
        }
    }

}
