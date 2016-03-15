<?php

Class CalendarController extends Controller {

    const DEPENDENCIES = ['Auth'];

    const PERMISSION_REQUIRED = User::STUDENT;

    public function index() {
        // Fill month data
        $this->set('month', [1, 2, 3]);

        $user = $this->auth->current();

        $this->set('user', $user);

    }

}
