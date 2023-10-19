<?php

    namespace Model;

    class Property extends ActiveRecord {
        protected static $table = "properties";
        protected static $dbColumns = ["id", "title", "price", "img", "description", "rooms", "wc", "parking", "created", "idagent"];

        public $id;
        public $title;
        public $price;
        public $img;
        public $description;
        public $rooms;
        public $wc;
        public $parking;
        public $created;
        public $idagent;

        // __construct is the function called along with the object, while the others are mothods that have to be called specifically

        public function __construct($args = []) {
            $this->id = $args["id"] ?? null;
            $this->title = $args["title"] ?? "";
            $this->price = $args["price"] ?? "";
            $this->img = $args["img"] ?? "";
            $this->description = $args["description"] ?? "";
            $this->rooms = $args["rooms"] ?? "";
            $this->wc = $args["wc"] ?? "";
            $this->parking = $args["parking"] ?? "";
            $this->created = date("Y/m/d");
            $this->idagent = $args["idagent"] ?? "";
        }

        public function validate() {
            if(!$this->title) {
                self::$errors[] = "You have to add a title";
            };
    
            if(!$this->price) {
                self::$errors[] = "You have to add a price";
            };
    
            if(strlen($this->description) < 50) {
                self::$errors[] = "You have to add a description with a minimum of 50 characters";
            };
    
            if(!$this->rooms) {
                self::$errors[] = "You have to add the number of bedrooms";
            };
    
            if(!$this->wc) {
                self::$errors[] = "You have to add the number of bathrooms";
            };
    
            if(!$this->parking) {
                self::$errors[] = "You have to add the number of parking lots";
            };
    
            if(!$this->idagent) {
                self::$errors[] = "You have to add an agent";
            };
    
            if(!$this->img) {
                 self::$errors[] = "You have to add an image";
             };
    
            return self::$errors;
        }
    }

?>