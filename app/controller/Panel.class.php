<?php

class PanelController extends Controller {

    const DEPENDENCIES = ['Auth'];

    // Students doesnt have a panel
    const PERMISSION_REQUIRED = User::TEACHER;

    public function index() {
        $this->set('user', $this->auth->current());
    }

}
