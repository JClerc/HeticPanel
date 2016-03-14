<?php

Class CalendarController extends Controller {

    const DEPENDENCIES = ['Auth'];

    const PERMISSION_REQUIRED = User::STUDENT;

    public function index() {
        // Fill month data
        $this->set('month', [1, 2, 3]);
        $this->set('user', $this->auth->current());
    }

}
