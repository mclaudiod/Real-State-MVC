<?php

    require "functions.php";
    require "config/database.php";
    require __DIR__ . "/../vendor/autoload.php";

    // Connect to the database

    $db = connectDB();
    $db->set_charset('utf8');
    
    use Model\ActiveRecord;

    ActiveRecord::setDB($db);