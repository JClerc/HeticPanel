<?php

class IndexController extends Controller {

    const DEPENDENCIES = ['Router', 'Auth'];

    const PERMISSION_REQUIRED = User::NONE;

    public function index() {
        // If user is logged
        if ($this->auth->isLogged()) {

            // Go to panel
            if ($this->auth->hasPermission(User::TEACHER)) {
                $this->router->go('panel');

            // Go to calender
            } else {
                $this->router->go('calendar');
            }

        // User is not logged
        } else {

            // Go to connection page
            $this->router->go('auth/login');
        }
    }

}
