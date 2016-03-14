<?php

abstract class DataModel extends Model {

    const DEPENDENCIES = ['Database'];

    const TABLE = null;

    protected $id = 0;
    protected $properties = null;

    public function fromId($id) {
        return $this->fromProperty('id', $id);
    }

    public function fromProperty($key, $value) {
        // Find model with that property
        $rows = $this->database->all($this->getTable(), [
            $key => $value,
        ]);

        if (count($rows) === 1) {
            $this->set($rows[0]);
            $this->id = intval($rows[0]['id']);
            return true;
        }

        return false;
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
            $this->setProperty($key, $value);

        }
    }

    private function setProperty($key, $value) {
        $this->properties[$key] = $value;
    }

    public function equals(DataModel $other) {
        return intval($this->id) === intval($other->getId());
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
            $this->database->update($this->getTable(), $this->properties, [
                'id' => $this->getId()
            ]);
        }
    }

    private function getTable() {
        if (!empty(static::TABLE)) {
            return static::TABLE;
        }

        $class = get_class($this);
        if (lcfirst($class) === strtolower($class)) {
            return strtolower($class) . 's';
        }

        throw new Exception('Don\'t know in what table "' .$class . '" should be stored');
    }

    private function make(array $properties) {
        $this->set($properties);
        $this->id = (int) $this->database->insert($this->getTable(), $this->properties);
        return $this->exists();
    }

}
