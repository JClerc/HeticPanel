<?php

class User extends Model {

    const DEPENDENCIES = ['Database', 'Crypt'];

    const NONE = 0;
    const STUDENT = 1;
    const TEACHER = 2;
    const STAFF = 3;

    private $id = 0;

    private $properties = [
        'username'   => '',
        'password'   => '',
        'email'      => '',
        'firstname'  => '',
        'lastname'   => '',
        'permission' => self::NONE,
    ];

    public function fromId($id) {
        // Find user with id
        $row = $this->database->get('users', [
            'id' => $id,
        ]);

        if (!empty($row)) {
            $this->set($row);
            $this->id = $row['id'];
            return true;
        }

        return false;
    }

    public function fromUsername($username) {
        // Find user with username
        $row = $this->database->get('users', [
            'username' => $username,
        ]);

        if (!empty($row)) {
            $this->set($row);
            $this->id = $row['id'];
            return true;
        }

        return false;
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

        $this->set([
            'username'   => $username,
            'password'   => $password,
            'email'      => $email,
            'firstname'  => $firstname,
            'lastname'   => $lastname,
            'permission' => $permission
        ]);

        // All is ok !
        $this->database->insert('users', $this->properties);
    }

    public function exists() {
        return $this->id > 0;
    }

    public function set($key, $value = null) {
        if (is_array($key)) {

            // Iterate over array
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }

        } else if (isset($this->properties[$key]) and isset($value)) {

            // Set properties
            $this->properties[$key] = $value;

        }
    }

    public function getId() {
        // Because id can't be changed
        return $this->id;
    }

    public function get($key) {
        return isset($this->properties[$key]) ? $this->properties[$key] : null;
    }

    public function save() {
        if ($this->exists()) {
            $this->database->update('users', $this->properties, [
                'id' => $this->getId()
            ]);
        }
    }

}
