<?php

class User extends DataModel {

    const DEPENDENCIES = ['Database', 'Crypt'];

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
        'group'      => 0,
    ];

    public function fromUsername($username) {
        // Find user with username
        return $this->fromProperty('username', $username);
    }

    public function create($username, $password, $email, $firstname, $lastname, $permission, $group = null) {
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
        if (strlen($username) < 3 or strlen($username) > 40)
            throw new Exception('Le nom d\'utilisateur est incorrect.');

        if (strlen($email) < 3 or strlen($email) > 100 or strpos($email, '@') === false)
            throw new Exception('L\'email est incorrecte.');

        if (strlen($password) < 3 or strlen($password) > 30)
            throw new Exception('Le mot de passe est incorrect.');

        if (strlen($firstname) < 3 or strlen($firstname) > 40)
            throw new Exception('Le prénom est incorrect.');

        if (strlen($lastname) < 3 or strlen($lastname) > 40)
            throw new Exception('Le nom est incorrect.');

        if ($permission < User::NONE or $permission > User::STAFF)
            throw new Exception('La permission est incorrecte.');

        $ret = $this->insert([
            'username'   => $username,
            'password'   => $this->crypt->createHash($password),
            'email'      => $email,
            'firstname'  => $firstname,
            'lastname'   => $lastname,
            'permission' => $permission,
            'group'      => 0
        ]);

        if ($ret and isset($group)) {
            $this->setGroup($group);
        }

        return $ret;

    }

    public function getGroup() {
        $group = Factory::create(new Group);
        $group->fromId($this->get('group'));
        return $group;
    }

    public function setGroup($group) {
        $groupId = 0;
        if ($group instanceof DataModel) $groupId = $group->getId();
        else if (is_string($group) or is_int($group)) $groupId = intval($group);
        else return;

        $this->set('group', $groupId);
        $this->save();

        if ($groupId > 0) { 
            $group = Factory::create(new Group);
            $group->fromId($groupId);
            $group->addStudent($this->getId());
            $group->save();
        } else {
            $this->removeGroup();
        }

    }

    public function removeGroup() {
        $groupId = intval($this->get('group'));

        if ($groupId > 0) {

            $group = Factory::create(new Group);
            $group->fromId($groupId);
            $group->removeStudent($this->getId());
            $group->save();

        }
    }

    public function setPassword($password) {
        if (strlen($password) < 3)
            throw new Exception('Le mot de passe est trop court.');

        if (strlen($password) > 30)
            throw new Exception('Le mot de passe est trop long.');

        $this->set('password', $this->crypt->createHash($password));
        $this->save();
    }

    public function delete() {
        if ($this->exists()) {
            $this->database->delete($this->getTable(), [
                'id' => $this->getId()
            ]);

            $this->removeGroup();

            $this->id = 0;
        }
    }

    public static function sortByLastName($list) {
        usort($list, function ($a, $b) {
            return strcmp($a->get('lastname'), $b->get('lastname'));
        });
        return $list;
    }

}
