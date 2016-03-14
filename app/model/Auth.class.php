<?php

class Auth {

    const DEPENDENCIES = ['Session', 'Crypt'];

    private $current = null;

    public function isLogged() {
        return $this->current()->exists();
    }

    public function hasPermission($perm) {
        // Get current user
        $userPermission = $this->current()->get('permission');

        if (is_int($perm)) {

            // Return true if user permission >= needed
            return $userPermission >= $perm;

        } else if ($perm instanceof Controller) {

            // Return true if user permission >= needed
            return $userPermission >= $perm::PERMISSION_REQUIRED;

        }

        // I don't know what to do
        return false;
    }

    public function login($username, $password) {
        // Create new user
        $user = Factory::create(new User);

        // Find user with username
        $user->fromUsername($username);

        // If user exists
        if ($user->exists()) {

            // Check password
            if ($this->crypt->compareHash($user->get('password'), $password)) {

                // Set current user
                $this->current = $user;

                // Store in session
                $this->session->set('current.user.id',       $user->getId());
                $this->session->set('current.user.username', $user->get('username'));
                $this->session->set('current.user.hash',     hash('sha256', $user->get('password')));

                // And login !
                return true;
            }

        }

        return false;
    }

    public function logout() {
        $this->session->remove('current.user.id');
        $this->session->remove('current.user.username');
        $this->session->remove('current.user.hash');
        $this->current = null;
    }

    public function current() {
        // Current user was not created
        if (!is_object($this->current)) {

            // If user session exists, attempt to login
            if ($this->session->has('current.user.id')) {

                // Get what we stored in session
                $id       = $this->session->get('current.user.id');
                $username = $this->session->get('current.user.username');
                $hash     = $this->session->get('current.user.hash');

                // Create a new user
                $user = Factory::create(new User);

                // Find user with id
                $user->fromId($id);

                // If user exists
                if ($user->exists()) {

                    // Check hash
                    $userHash = hash('sha256', $user->get('password'));
                    if ($this->crypt->equals($userHash, $hash)) {

                        // Set current user
                        $this->current = $user;

                        // And return it
                        return $this->current;

                    }

                }

                // Remove session, because it is invalid
                $this->logout();

            }

            // Set an empty user if not logged
            $this->current = Factory::create(new User);
        }

        // Return user if it exists
        return $this->current;
    }

}
