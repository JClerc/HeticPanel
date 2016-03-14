<?php

class User extends DataModel {

    const NONE = 0;
    const STUDENT = 1;
    const TEACHER = 2;
    const STAFF = 3;

    protected $properties = [
        'username'   => '',
        'password'   => '',
        'email'      => '',
        'firstname'  => '',
        'lastname'   => '',
        'permission' => self::NONE,
    ];

    public function fromUsername($username) {
        // Find user with username
        return $this->fromProperty('username', $username);
    }

    public function create($username, $password, $email, $firstname, $lastname, $permission) {
        // Check if username don't exists
        $row = $this->database->get('users', [ 'username' => $username ]);
        if (!empty($row)) {
            throw new Exception('Le nom d\'utilisateur est déjà pris.');
        }

        // Check if email don't exists
        $row = $this->database->get('users', [ 'email' => $username ]);
        if (!empty($row))
            throw new Exception('Un compte avec cet email existe déjà.');

        // Other verifications
        if (strlen($username) < 3 or strlen($username) > 20)
            throw new Exception('Le nom d\'utilisateur est incorrect.');

        if (strlen($email) < 3 or strlen($email) > 100 or strpos($email, '@'))
            throw new Exception('L\'email est incorrecte.');

        if (strlen($password) < 3 or strlen($password) > 20)
            throw new Exception('Le mot de passe est incorrect.');

        if (strlen($firstname) < 3 or strlen($firstname) > 20)
            throw new Exception('Le prénom est incorrect.');

        if (strlen($lastname) < 3 or strlen($lastname) > 20)
            throw new Exception('Le nom est incorrect.');

        if ($permission < User::NONE or $permission > User::STAFF)
            throw new Exception('La permission est incorrecte.');

        return $this->make([
            'username'   => $username,
            'password'   => $password,
            'email'      => $email,
            'firstname'  => $firstname,
            'lastname'   => $lastname,
            'permission' => $permission
        ]);

    }

}
