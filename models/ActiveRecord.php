<?php

    namespace Model;

    class ActiveRecord {
        
        // Database

        protected static $db;
        protected static $table = "";
        protected static $dbColumns = [];

        // Errors

        protected static $errors = [];

        // Define the connection to the Database

        public static function setDB($database) {
            self::$db = $database;
        }

        public function save() {
            if(!is_null($this->id)) {
                $this->update();
            } else {
                $this->create();
            }
        }

        public function create() {

            // Sanitize the data

            $atributes = $this->sanitizeAtributes();

            // Insert into the database

            // Join makes an string out of an array

            $query = "INSERT INTO " . static::$table . " (";
            $query .= join(", ", array_keys($atributes));
            $query .= ") VALUES ('";
            $query .= join("', '", array_values($atributes));
            $query .= "')";

            $result = self::$db->query($query);

            // Success message

            if($result) {
            
                // Redirect user
    
                header("Location: /admin?result=1");
                
            }
        }

        public function update() {
            
            // Sanitize the data

            $atributes = $this->sanitizeAtributes();

            $values = [];

            foreach($atributes as $key => $value) {
                $values[] = "{$key}='{$value}'";
            }

            // Insert into the database

            $query = "UPDATE " . static::$table . " SET ";
            $query .= join(", ", $values);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
            $query .= " LIMIT 1";

            $result = self::$db->query($query);

            // Success message

            if($result) {
            
            // Redirect user

            header("Location: /admin?result=2");

            }
        }

        // Delete a registry

        public function delete() {
            $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            $result = self::$db->query($query);

            if($result) {
                $this->deleteImage();
                header("location: /admin?result=3");
            };
        }

        // Identificate and link the atributes of the database

        public function atributes() {
            $atributes = [];
            foreach(static::$dbColumns as $column) {
                if($column === "id") continue;
                $atributes[$column] = $this->$column;
            }
            return $atributes;
        }

        public function sanitizeAtributes() {
            $atributes = $this->atributes();
            $sanitized = [];

            // Key is for the name of the variable and the value is for what is inside of it

            foreach($atributes as $key => $value) {
                $sanitized[$key] = self::$db->escape_string($value);
            }

            return $sanitized;
        }

        // Archive upload

        // get to obtain a value and set to modify a value

        public function setImage($img) {

            // Deletes the precious image

            if(!is_null($this->id)) {
                $this->deleteImage();
            }

            // Assign to the img atribute the image name

            if($img) {
                $this->img = $img;
            }
        }

        // Delete archive

        public function deleteImage() {

            // Check if the file exists

            $fileExists = file_exists(IMAGE_FOLDER . $this->img);

            if($fileExists) {
                unlink(IMAGE_FOLDER . $this->img);
            }
        }

        // Validation

        public static function getErrors() {
            return static::$errors;
        } 

        public function validate() {
            static::$errors = [];
            return static::$errors;
        }

        // Lists all the registries

        public static function all() {
            $query = "SELECT * FROM " . static::$table;
            $result = self::querySQL($query);
            return $result;
        }

        // Obtain determined number of registries

        public static function get($quantity) {
            $query = "SELECT * FROM " . static::$table . " LIMIT " . $quantity;
            $result = self::querySQL($query);
            return $result;
        }

        // Search a registry for it's id

        public static function find($id) {
            $query = "SELECT * FROM " . static::$table . " WHERE id = ${id}";
            $result = self::querySQL($query);
            return array_shift($result);
        }

        public static function querySQL($query) {

            // Query the database

            $result = self::$db->query($query);

            // Iterate the results

            $array = [];

            while($registry = $result->fetch_assoc()) {
                $array[] = static::createObject($registry);
            }

            // Liberate the memory

            $result->free();

            // Return the results

            return $array;
        }

        protected static function createObject($registry) {
            $object = new static;

            foreach($registry as $key => $value) {
                if(property_exists($object, $key)) {
                    $object->$key = $value;
                }
            }

            return $object;
        }

        // Synchronize the object in memory with the changes realized by the user

        public function synchronize($args = []) {
            foreach($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }
    }

?>