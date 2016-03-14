<?php

Class Flash {

    const DEPENDENCIES = ['Core', 'Session'];

    public function display() {
        if ($this->exists()) {

            // Remove it to avoid duplicate
            $flash = $this->remove();

            // And print it
            $this->core->view('module/elements/flash', $flash);
        }
    }

    public function set($success, $message) {
        // Store into session
        $this->session->set('flash', [
            'success' => $success,
            'message' => $message
        ]);
    }

    public function get() {
        return $this->session->get('flash');
    }

    public function exists() {
        return is_array($this->get());
    }

    public function remove() {
        // Remove and return it
        $flash = $this->get();
        $this->session->remove('flash');
        return $flash;
    }

}
