<?php

class Factory {


    private static $dependencies = [];

    public static function create($class) {
        self::inject($class);
        return $class;
    }

    public static function get($name) {

        // Check if it exists
        if (isset(self::$dependencies[$name])) {
            return self::$dependencies[$name];
        }

        // It may be a Model
        if (isset(self::$dependencies[$name . 'Model'])) {
            return self::$dependencies[$name . 'Model'];
        }

        return null;
    }

    public static function addDependency($model) {
        // Add dependecies
        self::inject($model);

        // Store with model name as key
        self::$dependencies[get_class($model)] = $model;
    }

    public static function getDependency($name) {
        // Return if it exists
        $object = self::get($name);
        if (isset($object)) return $object;

        // Or create it
        if (class_exists($name)) {
            $class = new $name;

        // It may be a Model
        } else {
            $modelName = $name . 'Model';
            if (class_exists($modelName)) {
                $class = new $modelName;
            }
        }

        // If it has been created, we store it
        if (is_object($class)) {
            self::addDependency($class);
            return $class;
        }

        return null;
    }

    private static function inject($object) {
        // Get class name
        $objectName = get_class($object);
        if (defined($objectName . '::DEPENDENCIES')) {

            // Get constant
            $classes = constant($objectName . '::DEPENDENCIES');

            // Iterate over dependencies
            foreach ($classes as $class) {

                // Retrieve it
                $dependency = self::getDependency($class);
                $property = strtolower($class);

                // And add it into
                if (isset($dependency)) {
                    $object->$property = $dependency;
                } else {
                    throw new Exception('Missing dependency: ' . $class);
                }

            }
        }
    }
    
}
