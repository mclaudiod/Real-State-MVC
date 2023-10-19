<?php

    namespace Model;

    class Agent extends ActiveRecord {
        protected static $table = "agents";
        protected static $dbColumns = ["id", "name", "surname", "phone"];

        public $id;
        public $name;
        public $surname;
        public $phone;

        // __construct is the function called along with the object, while the others are mothods that have to be called specifically

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->name = $args["name"] ?? "";
            $this->surname = $args["surname"] ?? "";
            $this->phone = $args["phone"] ?? "";
        }

        public function validate() {
            if(!$this->name) {
                self::$errors[] = "You have to add a name";
            };
    
            if(!$this->surname) {
                self::$errors[] = "You have to add a surname";
            };
    
            if(!$this->phone) {
                self::$errors[] = "You have to add a phone number";
            };

            // preg_match is a regular expression that searches for patterns on a string, it's useful if you want to make sure an email it's an email or in this case a string that only has numbers from the 0 to 9 and has a length of 10 characters

            if(!preg_match("/[0-9]{10}/", $this->phone)) {
                self::$errors[] = "That phone number is invalid";
            }
    
            return self::$errors;
        }
    }

?>