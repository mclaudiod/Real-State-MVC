<?php

    namespace Model;

    class Admin extends ActiveRecord {
        
        // Database

        protected static $table = "users";
        protected static $dbColumns = ["id", "email", "password"];

        public $id;
        public $email;
        public $password;

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->email = $args["email"] ?? "";
            $this->password = $args["password"] ?? "";
        }

        public function validate() {
            if(!$this->email) {
                self::$errors[] = "You have to add an email";
            }

            if(!$this->password) {
                self::$errors[] = "You have to add a password";
            }

            return self::$errors;
        }

        public function userExists() {
            
            // Check if the user exists

            $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

            $result = self::$db->query($query);

            if(!$result->num_rows) {
                self::$errors[] = "The user doesn't exist";
                return;
            }

            return $result;
        }

        public function checkPassword($result) {
            $user = $result->fetch_object();

            $authenticated = password_verify($this->password, $user->password);

            if(!$authenticated) {
                self::$errors[] = "The password is incorrect";
            }

            return $authenticated;
        }

        public function authenticate() {
            session_start();

            // Fill the session array

            $_SESSION["user"] = $this->email;
            $_SESSION["login"] = true;

            header("Location: /admin");
        }
    }