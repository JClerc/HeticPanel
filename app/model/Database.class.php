<?php

Class Database extends Model {

    const DEPENDENCIES = [];

    private $pdo = null;
    private $query = null;
    private $args = [];


    // Set connection
    // --------------------------------

    public function connect($host, $name, $user, $pass) {
        try {
            // Try to connect to database
            $pdo = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);

            // Set fetch mode to object
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;

            // Connected !
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function isConnected() {
        return is_object($this->pdo);
    }

    public function getPdo() {
        return $this->pdo;
    }


    // Main function
    // --------------------------------

    public function query($sql, $args = null) {

        // Prepare statement
        $stmt = $this->pdo->prepare($sql);

        // If we have arguments not null
        if (isset($args)) {

            // If this is not an array, we make one
            if (!is_array($args)) {
                $stmt->execute([$args]);
            } else {
                $stmt->execute($args);
            }

        } else {
            // No args
            $stmt->execute();
        }

        // Return pdo statement
        return $stmt;
    }


    // Helpers function
    // --------------------------------

    public function select($table, $where = null, $args = null) {
        // Reset args
        $this->args = [];

        // Start of statement
        $this->query = 'SELECT * FROM ' . $table;

        // WHERE a = b
        $this->appendWhere($where, $args);

        // Execute and return
        return $this->run();
    }

    public function get($table, $where = null, $args = null) {
        // This is sort of an alias for select() and fetch()
        return $this->select($table, $where, $args)->fetch();
    }

    public function all($table, $where = null, $args = null) {
        // This is sort of an alias for select() and fetchAll()
        return $this->select($table, $where, $args)->fetchAll();
    }

    public function update($table, $set = null, $where = null, $args = null) {
        // Reset args
        $this->args = [];

        // Start of statement
        $this->query = 'UPDATE ' . $table . ' SET';

        // SET (a, b, c)
        $this->appendUpdate($set);

        // WHERE a = b
        $this->appendWhere($where, $args);

        // Execute and return
        return $this->run();
    }

    public function insert($table, $values) {
        // Reset args
        $this->args = [];

        // Start of statement
        $this->query = 'INSERT INTO ' . $table;

        // (a, b, c) VALUES (x, y, z)
        $this->appendInsert($values);

        // Execute and return
        $this->run();

        // Return new id
        return $this->pdo->lastInsertId();
    }

    public function delete($table, $where = null, $args = null) {
        // Reset args
        $this->args = [];

        // Start of statement
        $this->query = 'DELETE FROM ' . $table;

        // WHERE a = b
        $this->appendWhere($where, $args);

        // Execute and return
        return $this->run();
    }


    // Private utils
    // --------------------------------

    private function appendWhere($where = null, $args = null) {
        // If empty there is no where
        if (!empty($where)) {

            // If this is an array: key = value
            if (is_array($where)) {

                // WHERE
                $this->query .= ' WHERE';

                $first = true;
                foreach ($where as $key => $value) {
                    // First doesnt have AND before
                    if ($first === true) $first = false;
                    else $this->query .= ' AND';
                    
                    // key = ?
                    $this->query .= ' ' . $key . ' = ?';
                    
                    // Because arguments are given at execution
                    $this->args[] = $value;
                }
            } else {
                // WHERE a = ?
                $this->query .= ' WHERE ' . $where;

                // Add arguments to array for later
                if (is_array($args)) {
                    foreach ($args as $arg) {
                        $this->args[] = $arg;
                    }
                }
            }
        }
    }

    private function appendUpdate($values) {
        foreach ($values as $key => $value) {
            // SET a = ?
            $this->query .= ' `' . $key . '` = ?,';

            // And add argument for later
            $this->args[] = $value;
        }
        $this->query = rtrim($this->query, ',');
    }

    private function appendInsert($array) {
        // If array is like [a => b]
        // We add (a, b, c) before VALUES
        if (!empty($array) and $this->isAssociative($array)) {
            $this->query .= ' (';
            foreach ($array as $key => $value) {
                 $this->query .= '`' . $key . '`,';
            }
            // Remove , add the end
            $this->query = trim($this->query, ',');
            $this->query .= ')';
        }

        // VALUES
        $this->query .= ' VALUES (';
        foreach ($array as $value) {
            // ?, ?, ?
            $this->query .= '?,';

            // Arguments for later
            $this->args[] = $value;
        }

        // Remove comma at the end
        $this->query = trim($this->query, ',');
        $this->query .= ')';
    }


    // Execute current
    // --------------------------------

    private function run() {
        // Get the statement
        $stmt = $this->query;

        // Get arguments
        $args = $this->args;

        // Execute and return
        return $this->query($stmt, $args);
    }


    // Tools
    // --------------------------------

    private function isAssociative($arr) {
        // Found here:
        // http://stackoverflow.com/a/173479
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
