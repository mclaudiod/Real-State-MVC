<?php

    namespace Model;

    class Entry extends ActiveRecord {
        protected static $table = "entries";
        protected static $dbColumns = ["id", "title", "idagent", "created", "img", "entry"];

        public $id;
        public $title;
        public $idagent;
        public $created;
        public $img;
        public $entry;

        // __construct is the function called along with the object, while the others are mothods that have to be called specifically

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->title = $args["title"] ?? "";
            $this->idagent = $args["idagent"] ?? "";
            $this->created = date("Y/m/d");
            $this->img = $args["img"] ?? "";
            $this->entry = $args["entry"] ?? "";
        }

        public function validate() {
            if(!$this->title) {
                self::$errors[] = "You have to add a title";
            };

            if(!$this->idagent) {
                self::$errors[] = "You have to add an author";
            };
    
            if(!$this->img) {
                self::$errors[] = "You have to add an image";
            };
            
            if(strlen($this->entry) < 50) {
                self::$errors[] = "You have to add an entry with a minimum of 50 characters";
            };

            return self::$errors;
        }
    }

?>