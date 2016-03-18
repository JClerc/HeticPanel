<?php

abstract class Model {

    const DEPENDENCIES = [];

    public static function make($id = null) {
        $class = get_called_class();
        return Factory::create(new $class);
    }

}
