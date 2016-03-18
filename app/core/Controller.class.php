<?php

abstract class Controller {

    private $data = [];

    // Dependencies will be added to object
    const DEPENDENCIES = [];

    // 0 = not logged
    // 1 = student
    // 2 = teacher
    // 3 = staff
    const PERMISSION_REQUIRED = User::NONE;

    // Auto include header and footer to view
    const INCLUDE_HEADER_FOOTER = true;

    final public function render($view) {
        if (static::INCLUDE_HEADER_FOOTER) $this->view('module/includes/header');
        $this->view($view);
        if (static::INCLUDE_HEADER_FOOTER) $this->view('module/includes/footer');
    }

    final public function view($view) {
        // If file exists
        if (is_file(VIEW . $view . '.php')) {

            // Easier way to access data
            $data = array_merge(Core::get(), $this->data);

            // Include the file
            require VIEW . $view . '.php';

            // Success !
            return true;

        } else {

            // Or return false
            return false;
        }
    }

    protected function set($key, $value) {
        $this->data[$key] = $value;
    }

    protected function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

}
