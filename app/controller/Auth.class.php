<?php

class AuthController extends Controller {

    const DEPENDENCIES = ['Router', 'Flash', 'Auth', 'Session'];

    const INCLUDE_HEADER_FOOTER = false;

    public function index() {
        // If user go to auth/
        $this->router->go('auth/login');
    }

    public function loginPost($request, $post) {
        // Attempt to login
        if ($this->auth->login($post['username'], $post['password'])) {

            // Add a message
            $this->flash->set(true, 'BRAVO');

            // Go either to panel or to calendar
            $this->router->go();

        // Error
        } else {

            // Add a message
            $this->flash->set(false, 'ERREUR');

            // Add data
            $this->set('username', 'inconnu');
        }
    }

    public function loginGet($request) {
        // No form was sended
        if ($this->auth->isLogged()) {

            // Print user from session
            $this->set('username', $this->auth->current()->get('username'));

        } else {

            // Print unknown
            $this->set('username', 'inconnu');
        }
    }

    public function logout($request) {
        // User is logged in
        if ($this->auth->isLogged()) {

            // Logout user
            $this->auth->logout();

            // Add a message
            $this->flash->set(true, 'Vous vous êtes déconnecté.');

        } else {

            // Logout to delete session
            $this->auth->logout();

            // Add a message
            $this->flash->set(false, 'Vous n\'étiez pas connecté.');

        }

        $this->router->go('auth/login');
    }

}
